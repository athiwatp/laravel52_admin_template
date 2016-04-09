<?php namespace App\Repositories;

use App\Models\Pages as Pages;
use Carbon\Carbon, Auth, Lang, Config, cTrackChangesUrl;
use App\Repositories\UrlHistoryRepository;
use App\Repositories\MenuesRepository;

class PagesRepository extends BaseRepository {
    /**
     * Url History instance
     *
     * @var App\Repositories\UrlHistoryRepository
     */
    protected $history = null;

    /**
     * Menu instance
     *
     * @var App\Repositories\UrlHistoryRepository
     */
    protected $menu = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\Pages $pages
     * @param UrlHistoryRepository $history
     * @param MenuesRepository $menu
     *
     * @return void
    */
    public function __construct(
        Pages $pages,
        UrlHistoryRepository $history = null,
        MenuesRepository $menu
    )
    {
        $this->model = $pages;

        // Inject url history object
        $this->history = $history;

        // Inject menu object
        $this->menu = $menu;
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
        foreach( $inputs as $key => $val ) {
            $page->$key = $val;
        }

        $page->user_id = Auth::id();

        $page->save();

        return true;
    }

    /**
     * Retrieve the menu item by the URL
     *
     * @param String $url
     *
     * @return App\Models\Menues
     */
    public function getByUrl( $url )
    {
        $mHistory = $this->history->getTypeId(
            $url,
            Config::get('constants.URL_HISTORY.TYPE_PAGE')
        );

        if ( $mHistory && $mHistory->status === true ) {
            $result = $this->model->findById( $mHistory->id );
        } else {
            $result = $this->model
                ->where( 'is_published', Config::get('constants.DONE_STATUS.SUCCESS') )
                ->where('url', $url)
                ->first();
        }

        if ( $result ) {
            return (object) $result->toArray();
        }

        return false;
    }

    /**
     * Get page that should be load by default (this query should be based on menu)
     *
     * @return Object
    */
    public function getDefaultPage()
    {
        $defMenu = $this->menu->getDefaultMenu();



        if ( $defMenu && $defMenu->page_id > 0 ) {

            $result = $this->getById( $defMenu->page_id );

            if ( $result ) {
                return (object) $result->toArray();
            }
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
