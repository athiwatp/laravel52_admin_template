<?php namespace App\Repositories;

use App\Models\Pages as Pages;
use App\Models\UrlHistory as UrlHistory;
use Carbon\Carbon, Auth, Lang, Config, cTrackChangesUrl;

class PagesRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Pages $pages
     *
     * @return void
    */
    public function __construct(Pages $pages)
    {
        $this->model = $pages;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Pages $pages
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
     * @param App\Models\Pages $pages
     *
     * @return
    */
    public function savePage( $page, $inputs )
    {
        $page->title            = $inputs['title'];
        $page->url              = $inputs['url'];
        $page->meta_keywords    = $inputs['meta_keywords'];
        $page->meta_descriptions = $inputs['meta_descriptions'];
        $page->content          = $inputs['content'];
        $page->user_id          = Auth::id();
        $page->is_published     = $inputs['is_published'];

        $page->save();

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

        if ( $id > 0 && $model->url != $inputs['url'] ) {
            $sSaveUrlHistory = cTrackChangesUrl::getItems(
                array(
                    'aData' => array(
                        'content_type' => Config::get('constants.URL_HISTORY.TYPE_PAGE'),
                        'url' => $inputs['url'],
                        'type_id' => $inputs['id']
                    )
                ));
        }

        $pages = $this->savePage( $model, $inputs );
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Pages $pages
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
     * @param App\Models\Pages
     *
     * @return void
    */
    public function destroy($pages)
    {
        $pages->delete();
    }

    /**
    * Prepare a list of pages for the combox
    */
    public static function getComboList()
    {
        $aItems = array(
            '-1' => ' --- ' . Lang::get('pages.lists.select_pages') . ' --- ',
            0 => ' *** ' . Lang::get('pages.lists.create_pages') . ' *** ' );

        $oItems = Pages::where('is_published', '=', Config::get('constants.DONE_STATUS.SUCCESS') )
            ->orderBy('title')
            ->get();

        foreach($oItems as $item) {
            $aItems[ $item->id ] = $item->title;
        }

        return $aItems;
    }


}
