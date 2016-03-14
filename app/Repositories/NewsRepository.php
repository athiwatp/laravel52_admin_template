<?php namespace App\Repositories;

use App\Models\News as News;
use Carbon\Carbon, Auth;

class NewsRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\News $news
     *
     * @return void
    */
    public function __construct(News $news)
    {
        $this->model = $news;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\News $news
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
     * @param App\Models\News $news
     *
     * @return
    */
    public function saveNews( $news, $inputs )
    {
        $news->title        = $inputs['title'];
        $news->content      = $inputs['content'];
        $news->chapter_id   = (isset($inputs['chapter_id']) ? $inputs['chapter_id'] : null );
        $news->user_id      = 1/*Auth::id()*/;
        $news->url          = $inputs['url'];
        $news->type_news    = '1';
        $news->date         = $inputs['date'];
        $news->source       = $inputs['source'];
        $news->photo        = (isset($inputs['image']) ? $inputs['image'] : null);
        $news->is_published = $inputs['is_published'];
        $news->is_main      = $inputs['is_main'];
        $news->is_important = $inputs['is_important'];

        $news->save();

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

        $news = $this->saveNews( $model, $inputs );

        // some post creation actions will be required
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
     * @param App\Models\News
     *
     * @return void
    */
    public function destroy($news)
    {
        $news->delete();
    }
}
