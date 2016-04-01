<?php namespace App\Repositories;

use App\Models\Menues as Menues;
use App\Models\UrlHistory as UrlHistory;
use Carbon\Carbon, Lang, Auth, Config, cTrackChangesUrl;

class MenuesRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Menues $menues
     *
     * @return void
    */
    public function __construct(Menues $menues)
    {
        $this->model = $menues;
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
        $oMenus    = self::getReadyUrl( $menu->children_count, $inputs['parent_id'], (isset($menu->parent_id) ? $menu->parent_id : '0') );
        
        $menu->title        = $inputs['title'];
        $menu->parent_id    = ( $inputs['parent_id'] > 0 ? $inputs['parent_id'] : 0 );
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

        $menu->save();

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
                        'content_type' => Config::get('constants.URL_HISTORY.TYPE_MENU'),
                        'url' => $inputs['url'],
                        'type_id' => $inputs['id']
                    )
                ));
        }
        $menues = $this->saveMenues( $model, $inputs );
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
     * Destroy a message
     *
     * @param App\Models\Menues
     *
     * @return void
    */
    public function destroy($id)
    {
        //
    }


    /**
    * Returns a list of menu types
    */
    public static function getTypes() {
        return array(
            Config::get('constants.TYPE_MENU.MAIN') => Lang::get('menues.form.type_main'),
            Config::get('constants.TYPE_MENU.SIDE') => Lang::get('menues.form.type_side'),
            Config::get('constants.TYPE_MENU.FOOTER') => Lang::get('menues.form.type_footer'),
            Config::get('constants.TYPE_MENU.HIDDEN_PAGE') => Lang::get('menues.form.type_hidden_page')
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

    public static function getMenu($bAllMenu = false)
    {
        $oAllMenu = Menues::select(array('static_menues.*'))
            ->orderBy('parent_id')
            ->orderBy('pos')
            ->orderBy('title');

        if ($bAllMenu === false) {
            $oAllMenu->where('is_published', '=', Config::get('constants.DONE_STATUS.SUCCESS') );
        }

        return $oAllMenu;
    }

    public static function getReadyUrl( $children_count, $iParentId, $iOldParentId ) {

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
            return $oMenus;
        }
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

    public static function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
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
    public static function getComboList()
    {
        $oItems = array();
        $aItems = array(
            '-1' => ' --- ' . Lang::get('menues.form.select_menu') . ' --- ',
            '0' => ' *** ' . Lang::get('menues.form.select_root_menu') . ' *** ',
        );

        $oAllMenu = self::getMenu(true)->orderBy('path')
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

            'content' => array(
                'title' => Lang::get('menues.nav.content'),
                'leftIcon' => '<i class="fa fa-book"></i>',
                'rightIcon' => '<i class="fa arrow"></i>',
                'children' => array(
                    'page' => array(
                        'title' => Lang::get('menues.nav.sidebar_page'),
                        'icon' => '<i class="fa fa-sticky-note"></i>',
                        'route' => 'admin.pages.index'
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
                'rightIcon' => '<i class="fa fa-angle-left pull-right"></i>',
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

                    'settings' => array(
                        'title' => Lang::get('settings.form.settings'),
                        'icon' => '<i class="fa fa-cog"></i>',
                        'route' => 'admin.settings.index'
                    )
                )
            )
        );
    }


}
