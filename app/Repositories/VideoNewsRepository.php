<?php namespace App\Repositories;

use App\Models\VideoNews as VideoNews;
use Carbon\Carbon, Auth;

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

        // some post creation actions will be required
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

    public function getParseUrl()
    {
        $parsed_url = parse_url($this->url);
        parse_str($parsed_url['query'], $parsed_query);
        return $parsed_query['v'];
    }


}
