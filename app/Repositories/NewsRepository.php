<?php namespace App\Repositories;

use App\Models\News as News;
use Carbon\Carbon;

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
    public function saveNews( $news, $inputs/*, $user_id*/)
    {

        /**
         * NEED TO IMPLEMENT NEWS SAVING PROCESS
        */
        //$news->save();

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
    public function store( $news, $inputs/*, $user_id*/)
    {
        $news = $this->saveNews(new $this->model, $inputs/*, $user_id*/);

        // some post creation actions will be required
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
