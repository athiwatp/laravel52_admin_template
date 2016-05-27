<?php namespace App\Repositories;

use App\Models\News as News;
use Illuminate\Http\Request;
use App\Models\UrlHistory as UrlHistory;
use App\Repositories\UrlHistoryRepository;
use Carbon\Carbon, Auth, cTrackChangesUrl, Config;

class NewsRepository extends BaseRepository {

    /**
     * URL History
     *
     * @var Object history
    */
    protected $history = null;

    /**
     * Published flag
     *
     * @var String
     */
    protected $PUBLISHED = 0;

    /**
     * Create a new Message instance
     *
     * @param App\Models\News $news
     *
     * @return void
    */
    public function __construct( News $news, UrlHistoryRepository $history )
    {
        // News Model
        $this->model = $news;

        // History
        $this->history = $history;

        // Retrieve the config settings
        $this->PUBLISHED = Config::get('constants.DONE_STATUS.SUCCESS');
    }

    /**
     * Create or update Message
     *
     * @param App\Models\News $news
     *
     * @return Collection of Object
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\News $news
     *
     * @return Collection of Object
    */
    public function getIndex()
    {
        return $this->model->where('is_published', '=', $this->PUBLISHED)->get();
    }

    /**
     * Retrieve the latest news from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     * @param Boolean $main
     *
     * @return Array
    */
    public function getLatest( $amount, $main = false )
    {
        $object = $this->model
            ->where('is_published', $this->PUBLISHED)
            ->orderBy('date', 'DESC')
            ->take( $amount );

        if ($main === true) {
            $object->where('is_main', '1');
        } elseif ($main === false) {
            $object->where('is_main', '0');
        }

        $result = $object->get();

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Returns the news which were added today
     *
     * @return Collection
    */
    public function getTodaysNews()
    {
        return $this->model->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = ?', [Carbon::today()->toDateString()])
            ->where('is_published', $this->PUBLISHED)
            ->orderBy('date', 'DESC')
            ->take(10)
            ->get();
    }

    /**
     * Get news for the calendar
    */
    public function getNewsForCalendar()
    {
        // Init the result array
        $result = [];

        // get the list of announces
        $list = $this->model
            ->where( 'is_published', $this->PUBLISHED )
            ->whereDate('date', '>=', Carbon::today()->subYear()->toDateString())
            ->orderBy('date', 'ASC')
            ->get();

        if ( $list ) {
            foreach($list as $item) {
                $result[ $item->date->year ][ $item->date->month ][ $item->date->day ][] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'date_start' => $item->date
                ];
            }
        }

        return $result;
    }

    /**
     * Reprive the list of news
     *
     * @param Request $request
     *
     * @return Collection
    */
    public function getPaginatedList(Request $request)
    {
        $chapter = $request->get( 'chapter' );
        $tag = $request->get( 'tag' );
        $timestamp = $request->get( 'timestamp' );

        $object = $this->model
            ->where('is_published', $this->PUBLISHED)
            ->orderBy('date', 'DESC');

        if ( $chapter && $chapter > 0) {
            $object->where('chapter_id', $chapter);
        }

        if ( $tag ) {
            $object->whereRaw('UPPER(tags) LIKE ?', [ '%' . $tag . '%'] );
        }

        if ( $timestamp && $timestamp > 0) {
            $dt = Carbon::createFromTimestamp( $timestamp );

            $dtStart = $dt->copy()->startOfDay()->toDateTimeString();
            $dtEnd   = $dt->copy()->endOfDay()->toDateTimeString();

            $object->where( 'date', '>=', $dtStart )
                ->where( 'date', '<=', $dtEnd );
        }

        $result = $object->paginate( $this->paginationAmount );

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Returns the NEWS item by the given URL
     *
     * @param String $url - url identifier
     *
     * @return Array
    */
    public function getByUrl( $url )
    {
        if ( empty($url) ) {
            return [];
        }

        $obj = $this->history
            ->getTypeId($url, Config::get('constants.URL_HISTORY.TYPE_NEWS'));

        if ( $obj && $obj->status === true ) {
            $result = $this->getById( $obj->id );
        } else {
            $result = $this->model
                ->where('url', $url)
                ->first();
        }

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Create or update Message
     *
     * @param App\Models\News $news
     *
     * @return
    */
    public function saveNews( $news, $inputs )
    {
        $news->title        = $inputs['title'];
        $news->content      = $inputs['content'];
        $news->chapter_id   = $inputs['chapter_id'];
        $news->user_id      = Auth::id();
        $news->url          = $inputs['url'];
        $news->type_news    = '1';
        $news->date         = $inputs['date'] ? Carbon::createFromFormat($this->dateFormat, $inputs['date'] ) : null;
        $news->source       = $inputs['source'];
        $news->is_published = $inputs['is_published'];
        $news->is_main      = $inputs['is_main'];
        $news->is_important = $inputs['is_important'];
        $news->tags         = $inputs['tags'];

        if ( $news->save() ) {
            return $news;
        }
        return false;
    }

    /**
     * Create a news
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\News | false )
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_NEWS');

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }
        $sUrl = $model->url;

        $aNews = $this->saveNews( $model, $inputs );

        $changeUrl = get_url_history($aNews['id'], $TYPE, $inputs['url'] );

        $this->fixChanges( $aNews['id'], ['url' => $changeUrl] );

        if ( $aNews ) {
            return $aNews->toArray();
        }
        return false;
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\News $news
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param {Int} $id
     *
     * @return {Boolean}
    */
    public function destroy($id)
    {
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_NEWS');

        $this->history->getDestroyById( $id, $TYPE );

        return parent::destroy($id);
    }

    public function getLatestNews()
    {
        return $this->model->orderBy('date', 'DESC')->take(10)->get();
    }

//     //// TEMP: SHOULD BE REMOVED
//     public function sync( $start )
//     {
//         $iAmount = 500;
//         $iIndex  = 0;

//         $aNews = $this->index();

//         $oldNews = DB::connection('old_db')->table('prm_news')
// //            ->take($iAmount)
// //            ->offset($start * $iAmount)
//             ->get();

//         foreach($oldNews as $oldItem) {
//             $news = $this->model
//                 ->where( 'title','=', htmlspecialchars_decode($oldItem->full_descr) )
//                 ->where( 'content', '=', htmlspecialchars_decode($oldItem->descr) )
//                 ->first();

//             if ($news && $news->count() > 0) {
//                 continue;
//             }

//             $addUrl = cTrackChangesUrl::addUrl( [
//                 'content_title' => strip_tags(
//                     htmlspecialchars_decode(
//                         $oldItem->full_descr
//                     )
//                 )
//             ]);

//             $nNews = new $this->model;
//             $dtObject = Carbon::createFromFormat('Y-m-d', $oldItem->createIt);

//             $dtCreate = $dtObject !== false && $dtObject->year > 0 ?
//                 $dtObject : Carbon::now()->subYears(10);

//             $nNews->title        = htmlspecialchars_decode($oldItem->full_descr);
//             $nNews->content      = htmlspecialchars_decode($oldItem->descr);
//             $nNews->chapter_id   = null;
//             $nNews->user_id      = 1;
//             $nNews->url          = $addUrl ? $addUrl->url : md5( time() );
//             $nNews->type_news    = '1';
//             $nNews->date         = $dtCreate->toDateString();
//             $nNews->source       = '';
//             $nNews->is_published = 1;
//             $nNews->is_main      = 0;
//             $nNews->is_important = 0;
//             $nNews->tags         = '';

//             $nNews->save();
//             $iIndex++;
//         }
//         $start++;

//         return array('start' => $start, 'index' => $iIndex);
//     }
//     ////


}
