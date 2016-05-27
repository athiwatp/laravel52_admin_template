<?php namespace App\Repositories;

use App\Models\Menues as Menues;
use App\Models\MenuLinked;
use Pingpong\Menus\MenuItem;
use App\Models\UrlHistory as UrlHistory;
use App\Repositories\UrlHistoryRepository;
use Carbon\Carbon, Lang, Auth, Config, cTrackChangesUrl;

class MenuesRepository extends BaseRepository {
    /**
     * Url History instance
     *
     * @var App\Repositories\UrlHistoryRepository
     */
    protected $history = null;

    /**
     * inject the LinkedMenu model
    */
    protected $linkedmenu = null;

    /**
     * Create a new Message instance
     *
     * @param App\Models\Menues $menues
     *
     * @return void
    */
    public function __construct( Menues $menues = null, UrlHistoryRepository $history = null, MenuLinked $linked = null )
    {
        if ( $menues === null ) {
            $menues = new Menues();
        }

        $this->model = $menues;

        if ( $linked === null ) {
            $linked = new MenuLinked();
        }

        // Inject url history object
        $this->history = $history;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Menues $menues
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
     * @param App\Models\Menues $menues
     *
     * @return
    */
    public function saveMenues( $menu, $inputs )
    {
        $oMenus = self::getReadyUrl(
            $menu->children_count,
            array_key_exists('parent_id', $inputs) ? $inputs['parent_id'] : null,
            $menu->parent_id > 0 ? $menu->parent_id : 0,
            $menu
        );

        $menu->parent_id    = ( array_key_exists('parent_id', $inputs) && $inputs['parent_id'] > 0 ? $inputs['parent_id'] : 0 );
        $menu->title        = $inputs['title'];
        $menu->path         = $oMenus['path'];
        $menu->pos          = ( isset($inputs['pos']) ? $inputs['pos'] : 0 );
        $menu->type_menu    = ( isset($inputs['type_menu']) ? $inputs['type_menu'] : 0 );
        $menu->page_id      = ( isset($inputs['page_id']) ? $inputs['page_id'] : null );
        $menu->url          = $inputs['url'];
        $menu->user_id      = Auth::id();
        $menu->redirect_url = ( isset($inputs['redirect_url']) ? $inputs['redirect_url'] : null );
        $menu->children_count   = ( isset($oMenus['children_count']) ? $oMenus['children_count'] : 0);
        $menu->is_published     = $inputs['is_published'];
        $menu->is_redirectable  = ( isset($inputs['is_redirectable']) ? $inputs['is_redirectable'] : 0 );
        $menu->is_loaded_by_default   = ( isset($inputs['is_loaded_by_default']) ? $inputs['is_loaded_by_default'] : 0);
        $menu->is_shown_print_version = ( isset($inputs['is_shown_print_version']) ? $inputs['is_shown_print_version'] : 0 );
        $menu->linked_to = ( array_key_exists('linked_to_menu', $inputs) ? $inputs['linked_to_menu'] : null);

        if ( $menu->save() ) {

            $this->linkedmenu
                ->where('id_linked_menu', $menu->id)
                ->delete();

            if ( $menu->linked_to > 0 ) {
                $this->linkedmenu->insert([
                    ['id_menu' => $menu->linked_to, 'id_linked_menu' => $menu->id]
                ]);
            }

            return $menu;
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
        $id   = array_key_exists('id', $inputs) ? $inputs['id'] : 0;
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_MENU');

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }
        $oldUrl = $model->url;

        $aMenues = $this->saveMenues( $model, $inputs );

        if ( $oldUrl != $inputs['url'] ) {
            $changeUrl = get_url_history($aMenues['id'], $TYPE, $inputs['url'] );
            $this->fixChanges( $aMenues['id'], ['url' => $changeUrl] );
        }

        if ( $aMenues ) {
            return $aMenues;
        }
        return false;
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Menues $menues
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Where Message
     *
     * @param App\Models\Menues $menues
     *
     * @return
    */
    public function where( $field, $sign ,$request )
    {
        return $this->model->where($field, $sign, $request );
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Menues
     *
     * @return void
    */
    public function destroy($id)
    {
        $TYPE = Config::get('constants.URL_HISTORY.TYPE_MENU');

        $this->history->getDestroyById( $id, $TYPE );

        return parent::destroy($id);
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
            Config::get('constants.URL_HISTORY.TYPE_MENU')
        );

        if ( $mHistory && $mHistory->status === true ) {
            $result = $this->getById( $mHistory->id );
        } else {
            $result = $this->getMenu()
                ->where('url', $url)
                ->first();
        }

        if ( $result ) {
            return (object) $result->toArray();
        }

        return false;
    }

    /**
     * Returns menu, that marked as default
     *
     * @return Object
    */
    public function getDefaultMenu()
    {
        $OK = Config::get('constants.DONE_STATUS.SUCCESS');

        $result = $this->model
            ->where('is_loaded_by_default', $OK)
            ->where('is_published', $OK )
            ->orderBy('created_at', 'DESC')
            ->first();

        if ( $result ) {
            return (object) $result->toArray();
        }

        return false;
    }

    /**
    * Returns a list of menu types
    */
    public static function getTypes() {
        return array(
            Config::get('constants.TYPE_MENU.MAIN') => Lang::get('menues.form.type_main'),
            Config::get('constants.TYPE_MENU.SIDE') => Lang::get('menues.form.type_side'),
            Config::get('constants.TYPE_MENU.FOOTER') => Lang::get('menues.form.type_footer')
        );
    }

    /**
     * Static list for the menu types
    */
    public static function getMenuTypes()
    {
        return array_merge( array(
            '0' => ' --- ' . Lang::get('menues.form.select_type_main') . ' --- ' ), self::getTypes()
        );
    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Menues $menues
     *
     * @return
    */
    public function getMenu($bAllMenu = false)
    {
        $oAllMenu = $this->model
            // ->orderBy('parent_id')
            ->orderBy('pos')
            ->orderBy('title');

        if ($bAllMenu === false) {
            $oAllMenu->where('is_published', '=', Config::get('constants.DONE_STATUS.SUCCESS') );
        }

        return $oAllMenu;
    }

    /**
     *
    */
    public static function getReadyUrl( $children_count, $iParentId, $iOldParentId, $oMenu )
    {
        $oMenus = [
            'path' => $oMenu ? $oMenu->path : null,
            'children_count' => $oMenu ? $oMenu->children_count : 0
        ];

        if ( $iParentId != $iOldParentId ) {

            if ( empty($iParentId) && $iOldParentId > 0) {
                if ($oParentMenu = Menues::find($iOldParentId)) {
                    $oMenus['children_count'] = $oParentMenu->children_count - 1;
                }

                $oMenus['path'] = self::getParentPath($iOldParentId, $oMenu->path, 'remove');
            } else {
                $oParentMenu = Menues::find($iParentId);
                
                if ( $oParentMenu ) {
                    $oMenus['children_count'] = $oParentMenu->children_count + 1;

                    $oMenus['path'] = self::getParentPath($iParentId, $oParentMenu->path);
                }
            }
        }

        return $oMenus;
    }

    public static function getParentPath($iParentId, $sParentPath = '', $sAction = 'add')
    {
        $sResult = '';
        $sNodeId = 'zZ' . $iParentId . 'zZ';

        if ($sAction == 'add') {
            $sResult = $sParentPath ? $sParentPath . ',' . $sNodeId : $sNodeId; 
        } else {
            $sResult = str_replace($sNodeId, '', $sParentPath);
        }

        return $sResult;
    }

    /**
     * Build a tree for the menu
     *
    */
    public static function buildTree(array $elements, $parentId = 0, $linked = false ) {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId || $linked === true) {

                if ( $linked === true && $element['linked_to'] == 0) {
                    continue;
                }

                $children = self::buildTree($elements, $element['id']);

                if ($children) {
                    $element['children'] = $children;
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }

    /**
     * Build a tree view for the combobox
     * @param  [type]  $aMenu      [description]
     * @param  integer $multiplier [description]
     * @return [type]              [description]
     */
    public static function shifterForMenu($aMenu, $multiplier = 1)
    {
        $sResult  = [];
        $sShifter = '';

        for( $i = 0; $i < $multiplier; $i++) {
            $sShifter .= '*';
        }

        foreach($aMenu as $menuItem) {
            $aSub      = array();
            $sResult[] = array('key' => $menuItem['id'], 'value' => $sShifter . ' ' . $menuItem['title'] );

            if(array_key_exists('children', $menuItem) && count($menuItem['children']) > 0) {
                $aSub    = self::shifterForMenu($menuItem['children'], $multiplier + 1);
                $sResult = array_merge($sResult, $aSub);
            } 
        }       

        return $sResult;
    }

    /**
    * Prepare a list of menues for the combox
    */
    public function getComboList()
    {
        $oItems = array();
        $aItems = array(
            '-1' => ' --- ' . Lang::get('menues.form.select_menu') . ' --- ',
            '0' => ' *** ' . Lang::get('menues.form.select_root_menu') . ' *** ',
        );

        $oAllMenu = $this->getMenu(true)->orderBy('path')
            ->orderBy('pos')
            ->orderBy('title')
            ->get();

        $aTree  = self::buildTree($oAllMenu ? $oAllMenu->toArray() : array() );

        if ( $aTree ) {
            $oItems = self::shifterForMenu($aTree);
        }

        foreach($oItems as $item) {
            $aItems[ $item['key'] ] = $item['value'];
        }

        return $aItems;
    }

    /**
     * [getMainMenu description]
     * @return [type] [description]
     */
    public function getMainMenu()
    {
        return $this->getMenu()
            ->where('type_menu', '=', Config::get('constants.TYPE_MENU.MAIN'))
            ->get();
    }

    /**
     * [getFooterMenu description]
     * @return [type] [description]
     */
    public function getFooterMenu()
    {
        return $this->getMenu()
            ->where('type_menu', '=', Config::get('constants.TYPE_MENU.FOOTER') )
            ->get();
    }

    /**
     * Retrieve child elements
     */
    public function child( $parentId )
    {
        return $this->model->whereRaw('path LIKE ?', ['%zZ' . $parentId . 'zZ%'])
            ->orderBy('path')
            ->get();
    }

    /**
     * Returns sidebar menu
     *
     * @return Object
    */
    public function getSidebarMenu( $menu_id = 0 )
    {
        $query = $this->getMenu()
            ->where('type_menu', Config::get('constants.TYPE_MENU.SIDE') );

        if ( $menu_id > 0 ) {
            $query->where('linked_to', $menu_id);
        } else {
            $query->where(function($q){
                $q->whereNull( 'linked_to' )
                    ->orWhere( 'linked_to', 0);
            });
        }

        return $query->get();
    }

    /**
     * [createItem description]
     * @param  [type] $oMenuItem  [description]
     * @param  [type] $globalMenu [description]
     * @return [type]             [description]
     */
    public static function createItem($oMenuItem, $globalMenu) {

        if(array_key_exists('children', $oMenuItem) && count($oMenuItem['children']) > 0) {
            $aSubMenu = $oMenuItem['children'];

            $globalMenu->dropdown($oMenuItem['title'], function(MenuItem $sub) use ($aSubMenu) {
                //$sub->setPresenter('RightSidebarPresenter');

                foreach($aSubMenu as $subItem) {
                    if (array_key_exists('children', $subItem) && count($subItem['children']) > 0) {
                        self::createItem($subItem, $sub);
                    } else {
                        $sub->url(
                            route('menu-url', [
                                'url' => $subItem['url']
                            ]),

                            $subItem['title']
                        );
                    }
                }
            });
        } else {
            $globalMenu->url(
                route('menu-url', [
                    'url' => $oMenuItem['url']
                ]),

                $oMenuItem['title']
            );
        }
    }

    /**
     *
     *
     *
    */
    public static function getRoute()
    {
        $aRoute = array(
            '/' => Lang::get('menues.route.dashboard'),
            '/announce' => Lang::get('menues.route.announce'),
            '/news' => Lang::get('menues.route.news'),
            '/video' => Lang::get('menues.route.video_news'),
            '/gallery' => Lang::get('menues.route.gallery'),
            );

        return $aRoute;
    }

        /**
     * Sidebar menu for administrator
     * @return [type] [description]
     */
    public static function getAdminSiderbarMenu()
    {
        return array(

            'general' => array(
                'title' => Lang::get('menues.nav.dashboard'),
                'leftIcon' => '<i class="fa fa-dashboard"></i>',
                'route' => 'admin.dashboard'
            ),

            'announcements' => array(
                'title' => Lang::get('menues.nav.announcements_management'),
                'leftIcon' => '<i class="fa fa-bullhorn"></i>',
                'rightIcon' => '<i class="fa arrow"></i>',
                'children' => array(
                    'chapter_announcements' => array(
                        'title' => Lang::get('menues.nav.chapter_announcements_management'),
                        'icon' => '<i class="fa fa-th-list"></i>',
                        'route' => 'admin.chapter.announcements'
                    ),
                    'announcements' => array(
                        'title' => Lang::get('menues.nav.announcements'),
                        'icon' => '<i class="fa fa-bullhorn"></i>',
                        'route' => 'admin.announcements.index'
                    )
                )
            ),

            'content' => array(
                'title' => Lang::get('menues.nav.content'),
                'leftIcon' => '<i class="fa fa-book"></i>',
                'rightIcon' => '<i class="fa arrow"></i>',
                'children' => array(
                    'page' => array(
                        'title' => Lang::get('menues.nav.sidebar_page'),
                        'icon' => '<i class="fa fa-sticky-note"></i>',
                        'route' => 'admin.pages.index'
                    ),
                    'customerReviews' => array(
                        'title' => Lang::get('menues.nav.customer_reviews'),
                        'icon' => '<i class="fa fa-comment"></i>',
                        'route' => 'admin.customerReviews.index'
                    )
                )
            ),

            'links' => array(
                'title' => Lang::get('menues.nav.useful-links'),
                'leftIcon' => '<i class="fa fa-link"></i>',
                'rightIcon' => '<i class="fa arrow"></i>',
                'children' => array(
                   'chapter_useful_links' => array(
                       'title' => Lang::get('menues.nav.chapter_useful_links'),
                       'icon' => '<i class="fa fa-qrcode"></i>',
                       'route' => 'admin.chapter.usefulLinks'
                   ),
                    'useful_links' => array(
                       'title' => Lang::get('menues.nav.useful-links'),
                       'icon' => '<i class="fa fa-link"></i>',
                       'route' => 'admin.usefulLinks.index'
                   )
                )
            ),

            'news' => array(
                'title' => Lang::get('menues.nav.news_online'),
                'leftIcon' => '<i class="fa fa fa-trello fa-fw"></i>',
                'rightIcon' => '<span class="fa arrow"></span>',
                'children' => array(
                    'chapter_news' => array(
                        'title' => Lang::get('menues.nav.chapter_news_management'),
                        'icon' => '<i class="fa fa-object-group"></i>',
                        'route' => 'admin.chapter.index'
                    ),

                    'news' => array(
                        'title' => Lang::get('menues.nav.news_online'),
                        'icon' => '<i class="fa fa-list-alt"></i>',
                        'route' => 'admin.news.index'
                    ),

                    'video-news' => array(
                        'title' => Lang::get('menues.nav.video_news'),
                        'icon' => '<i class="fa fa-video-camera"></i>',
                        'route' => 'admin.videoNews.index'
                    )
                ) 
            ),

            'gallery' => array(
                'title' => Lang::get('menues.nav.gallery'),
                'leftIcon' => '<i class="fa fa-picture-o"></i>',
                'rightIcon' => '<i class="fa arrow"></i>',
                'children' => array(
                    'gallery-chapters' => array(
                        'title' => Lang::get('menues.nav.gallery_chapter'),
                        'icon' => '<i class="fa fa-clone"></i>',
                        'route' => 'admin.chapter.gallery'
                    ),

                    'media' => array(
                        'title' => Lang::get('menues.nav.photo_gallery'),
                        'icon' => '<i class="fa fa-camera"></i>',
                        'route' => 'admin.gallery.index'
                    ),
                )
            ),

            'settings' => array(
                'title' => Lang::get('settings.form.settings'),
                'leftIcon' => '<i class="fa fa-cogs"></i>',
                'rightIcon' => '<span class="fa arrow"></span>',
                'children' => array(
                    'menu' => array(
                        'title' => Lang::get('menues.nav.menu_management'),
                        'icon' => '<i class="fa fa-circle-o"></i>',
                        'route' => 'admin.menu.index'
                    ),

                    'user' => array(
                        'title' => Lang::get('menues.nav.users_management'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'route' => 'admin.users.index'
                    ),

                    'subscribers' => array(
                        'title' => Lang::get('menues.nav.subscribers_management'),
                        'icon' => '<i class="fa fa-rss"></i>',
                        'route' => 'admin.subscribers.index'
                    ),

                    'settings' => array(
                        'title' => Lang::get('settings.form.settings'),
                        'icon' => '<i class="fa fa-cog"></i>',
                        'route' => 'admin.settings.index'
                    ),

                    'logs' => array(
                        'title' => Lang::get('menues.nav.logs'),
                        'icon' => '<i class="fa fa-wrench"></i>',
                        'route' => 'admin.logs'
                    )
                )
            )
        );
    }


}
