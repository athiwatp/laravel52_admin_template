<?php namespace App\Repositories;

use App\Models\VideoNews as VideoNews;
use Carbon\Carbon, Auth, Config;
use Illuminate\Http\Request;

class VideoNewsRepository extends BaseRepository {

    /**
     * URL History
     *
     * @var Object history
    */
    protected $history = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\VideoNews $videoNews
     *
     * @return void
    */
    public function __construct( VideoNews $videoNews, UrlHistoryRepository $history )
    {
        // Video news Model
        $this->model = $videoNews;

        // History
        $this->history = $history;

        // Retrieve the config settings
        $this->PUBLISHED = Config::get('constants.DONE_STATUS.SUCCESS');
    }

        /**
     * Create or update Message
     *
     * @param App\Models\VideoNews $videoNews
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\VideoNews $videoNews
     *
     * @return
    */
    public function getIndex()
    {
        return $this->model->where('is_published', '=', $this->PUBLISHED)->get();
    }

    /**
     * Retrieve the latest news from DB
     *
     * @param int $amount - amount of records that we need to retrieve
     *
     * @return Array
     */
    public function getLatest( $amount )
    {
        $result = $this->model
            ->orderBy('date', 'DESC')
            ->take( $amount )
            ->get();

        if ( $result ) {
            return $result;
        }

        return [];
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
        $result = $this->model
            ->orderBy('date', 'DESC')
            ->paginate( $this->paginationAmount );

        if ( $result ) {
            return $result;
        }

        return [];
    }

    /**
     * Create or update Message
     *
     * @param App\Models\VideoNews $videoNews
     *
     * @return
    */
    public function saveVideoNews( $videoNews, $inputs )
    {
        $videoNews->title        = $inputs['title'];
        $videoNews->content      = $inputs['content'];
        $videoNews->date         = $inputs['date'] ? Carbon::createFromFormat($this->dateFormat, $inputs['date'] ) : Carbon::now()->toDateString();
        $videoNews->youtube_url  = $inputs['youtube_url'];
        $videoNews->url          = $inputs['url'];
        $videoNews->is_published = $inputs['is_published'];
        $videoNews->user_id      = Auth::id();

        if ( $videoNews->save() ) {
            return $videoNews;
        }
        return false;
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_VIDEO');

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $videoNews = $this->saveVideoNews( $model, $inputs );

        $changeUrl = get_url_history($videoNews['id'], $TYPE, $inputs['url'] );
        $this->fixChanges( $videoNews['id'], ['url' => $changeUrl] );

        if ( $videoNews ) {
            return $videoNews;
        }
        return false;
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\VideoNews $videoNews
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
     * @param App\Models\News
     *
     * @return void
    */
    public function destroy($id)
    {
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_VIDEO');

        $this->history->getDestroyById( $id, $TYPE );

        return parent::destroy($id);
    }

}
