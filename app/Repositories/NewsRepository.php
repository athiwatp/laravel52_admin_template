<?php namespace App\Repositories;

use App\Models\News as News;
use Carbon\Carbon, Auth, cTrackChangesUrl, Config;
use Illuminate\Http\Request;

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
    public function __construct(News $news, UrlHistoryRepository $history)
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
            $dt = Carbon::createFromTimestamp( $timestamp )->addDay();

            $object->where('date', '=', $dt->toDateString() );
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
        $news->chapter_id   = ( isset($inputs['chapter_id']) ? $inputs['chapter_id'] : null );
        $news->user_id      = Auth::id();
        $news->url          = $inputs['url'];
        $news->type_news    = '1';
        $news->date         = $inputs['date'] ? Carbon::createFromFormat($this->dateFormat, $inputs['date'] ) : null;
        $news->source       = $inputs['source'];
        $news->is_published = $inputs['is_published'];
        $news->is_main      = $inputs['is_main'];
        $news->is_important = $inputs['is_important'];
        $news->tags         = $inputs['tags'];

        $news->save();

        return true;
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

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        if ( $id > 0 && $model->url != $inputs['url'] ) {
            cTrackChangesUrl::getItems(
                array(
                    'aData' => array(
                        'content_type' => Config::get('constants.URL_HISTORY.TYPE_NEWS'),
                        'url' => $inputs['url'],
                        'type_id' => $inputs['id']
                    )
                )
            );
        }

        if ( $this->saveNews( $model, $inputs ) ) {
            return $model->toArray();
        } else {
            return false;
        }
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
        return parent::destroy($id);
    }
}
