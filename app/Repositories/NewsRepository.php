<?php namespace App\Repositories;

use App\Models\News as News;
use App\Models\UrlHistory as UrlHistory;
use Carbon\Carbon, Auth, cTrackChangesUrl;

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
        $news->chapter_id   = ( isset($inputs['chapter_id']) ? $inputs['chapter_id'] : null );
        $news->user_id      = Auth::id();
        $news->url          = $inputs['url'];
        $news->type_news    = '1';
        $news->date         = $inputs['date'];
        $news->source       = $inputs['source'];
        $news->is_published = $inputs['is_published'];
        $news->is_main      = $inputs['is_main'];
        $news->is_important = $inputs['is_important'];

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
     * @param App\Models\News
     *
     * @return void
    */
    public function destroy($news)
    {
        $news->delete();
    }
}
