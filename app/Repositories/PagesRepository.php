<?php namespace App\Repositories;

use App\Models\Pages as Pages;
use App\Repositories\UrlHistoryRepository;
use App\Repositories\MenuesRepository;
use Carbon\Carbon, Auth, Lang, Config, cTrackChangesUrl;

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

        if ( $page->save() ) {
            return $page;
        }
        return false;
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
            $result = $this->getById( $mHistory->id );
        } else {
            $result = $this->model
                ->where( 'is_published', Config::get('constants.DONE_STATUS.SUCCESS') )
                ->where('url', $url)
                ->first();
        }

        if ( $result ) {
            return $result;
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
     * Full text search
     *
     * @param Array [$keywords] - the list of text phrases we age going to search for
     *
     * @return Array of page collections
    */
    public function search($keywords)
    {
        return $this->model->search( $keywords );
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
        $id = array_key_exists('id', $inputs) ? $inputs['id'] : 0;
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_PAGE');

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }
        $oldUrl = $model->url;

        $aPage = $this->savePage( $model, $inputs );

        if ( $oldUrl != $inputs['url'] ) {
            $changeUrl = get_url_history($aPage['id'], $TYPE, $inputs['url'] );
            $this->fixChanges( $aPage['id'], ['url' => $changeUrl] );
        }

        if ( $aPage ) {
            return $aPage->toArray();
        } else {
            return false;
        }
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
     * @param {Int} id - identifier for the page
     *
     * @return void
    */
    public function destroy($id)
    {
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_PAGE');

        $this->history->getDestroyById( $id, $TYPE );

        return parent::destroy($id);
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



    //// TEMP: SHOULD BE REMOVED

    public function sync( $start = 0 )
    {
        $aTypeMenu = Config::get('constants.TYPE_MENU');

        // Create main menu
        $this->_createStructure([
                '1' => 'Знайомство з містом',
                '2' => 'Місто офіційне',
                '3' => 'Економіка',
                '4' => 'Гуманітарна сфера',
                '5' => 'Сервіс та відпочинок',
                '6' => 'Зв\'язок з громадськістю'
            ], [$aTypeMenu['MAIN'], $aTypeMenu['FOOTER']]
        );

    }

    /**
     *
    */
    private function _createStructure( $aMenu, $mMenuTypes, $bCreateMainMenu = true )
    {
        $aAvailability = Config::get('constants.DONE_STATUS');
        $aTypeMenu     = Config::get('constants.TYPE_MENU');

        DB::beginTransaction();

        $aTypes = $mMenuTypes;
        if ( ! is_array($mMenuTypes) ) {
            $aTypes = [$mMenuTypes];
        }

        $index = 0;
        foreach( $aMenu as $key => $val ) {
            $iMainMenuId = [];

            if ( $bCreateMainMenu ) {
                $page = $this->store([
                    'title' => $val,
                    'url' =>  md5($val),
                    'meta_keywords' => $val,
                    'meta_descriptions' => $val,
                    'user_id' => 1  ,
                    'content' => '',
                    'is_published' => $aAvailability['SUCCESS']
                ]);

                // 1. Create menu
                foreach($aTypes as $type) {
                    $menu = $this->menu->store([
                        'title' => $val,
                        'type_menu' => $type,
                        'url' => md5($val . time() ),
                        'page_id' => $page ? $page['id'] : null,
                        'pos' => $index,
                        'is_published' => $aAvailability['SUCCESS']
                    ]);

                    // Get Main menu id
                    if ( $menu ) {
                        $iMainMenuId[] = $menu->id;
                    }
                }
            } else {
                $iMainMenuId[] = 0;
            }

            // 1.1. Get data from content table
            $contents = DB::connection('old_db')->table('content')
                ->where('razdel_id', $key)
                ->get();

            if ( $contents ) {

                $sMainPageContent = '<ul>';
                foreach($contents as $ind => $submenu) {
                    $url = md5($submenu->name);

                    // 1.1.1: Create page
                    $subPage = $this->store([
                        'title' => $submenu->name,
                        'url' =>  $url,
                        'meta_keywords' => $submenu->name,
                        'meta_descriptions' => $submenu->name,
                        'user_id' => 1  ,
                        'content' => htmlspecialchars_decode( $submenu->content ),
                        'is_published' =>  $submenu->old == 0 ? $aAvailability['SUCCESS'] : $aAvailability['FAILURE']
                    ]);

                    if ( $subPage ) {
                        $iPageId = $subPage['id'];

                        // 1.1.2: Create sub menu and link it to the main menu
                        foreach( $iMainMenuId as $idx => $mainMenuId) {

                            if ( $idx === 0 ) {
                                $subMenuObject = $this->menu->store([
                                    'title' => $submenu->name,
                                    'type_menu' => $aTypeMenu['SIDE'],
                                    'parent_id' => $mainMenuId > 0 ? $mainMenuId : null,
                                    'pos' => $ind,
                                    'page_id' => $iPageId,
                                    'url' => $url . time(),
                                    'linked_to_menu' => $mainMenuId > 0 ? $mainMenuId : null,
                                    'is_published' =>  $submenu->old == 0 ? $aAvailability['SUCCESS'] : $aAvailability['FAILURE']
                                ]);
                            } else {
                                if ( $subMenuObject && $mainMenuId > 0 ) {
                                    DB::table('static_linked_menu')->insert([
                                        ['id_menu' => $mainMenuId, 'id_linked_menu' => $subMenuObject->id]
                                    ]);
                                }
                            }
                        }

                        $sMainPageContent .= '<li><a href="' . route('page-url', $url) . '" title="' . $submenu->name . '">' .  $submenu->name . '</a></li>';
                    }
                }

                $sMainPageContent .= '</ul>';

                if ( $bCreateMainMenu ) {
                    $oPage = $this->getById($page['id']);

                    if ($oPage) {
                        $oPage->content = $sMainPageContent;
                        $oPage->save();
                    }
                }
            }

            $index++;
        }

        DB::commit();

        return true;
    }
    ////



}
