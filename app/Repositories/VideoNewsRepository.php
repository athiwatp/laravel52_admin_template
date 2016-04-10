<?php namespace App\Repositories;

use App\Models\VideoNews as VideoNews;
use Carbon\Carbon, Auth;
use Illuminate\Http\Request;

class VideoNewsRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\VideoNews $videoNews
     *
     * @return void
    */
    public function __construct(VideoNews $videoNews)
    {
        $this->model = $videoNews;
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
            ->paginate(50);

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
        $videoNews->date         = $inputs['date'];
        $videoNews->url          = $inputs['url'];
        $videoNews->is_published = $inputs['is_published'];
        $videoNews->user_id      = Auth::id();

        $videoNews->save();

        return true;
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

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $videoNews = $this->saveVideoNews( $model, $inputs );
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
    public function destroy($videoNews)
    {
        $videoNews->delete();
    }

}
