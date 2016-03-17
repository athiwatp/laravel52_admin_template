<?php namespace App\Repositories;

use App\Models\Menues as Menues;
use Carbon\Carbon, Lang;

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
        $menu->title        = $inputs['title'];
        $menu->parent_id    = ( isset($inputs['parent_id']) ? $inputs['parent_id'] : null );
        $menu->path         = ( isset($inputs['path']) ? $inputs['path'] : null );
        $menu->pos          = ( isset($inputs['pos']) ? $inputs['pos'] : 0 );
        $menu->type_menu    = ( isset($inputs['type_menu']) ? $inputs['type_menu'] : 0 );
        $menu->page_id      = ( isset($inputs['page_id']) ? $inputs['page_id'] : null );
        $menu->url          = $inputs['url'];
        $menu->redirect_url = ( isset($inputs['redirect_url']) ? $inputs['redirect_url'] : null );
        $menu->user_id      = 1/*Auth::id()*/;
        $menu->is_published           = $inputs['is_published'];
        $menu->is_redirectable        = ( isset($inputs['is_redirectable']) ? $inputs['is_redirectable'] : 0 );
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

        $menues = $this->saveMenues( $model, $inputs );

        // some post creation actions will be required
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
            Menues::TYPE_MAIN => Lang::get('menues.form.type_main'),
            Menues::TYPE_SIDE => Lang::get('menues.form.type_side'),
            Menues::TYPE_FOOTER => Lang::get('menues.form.type_footer'),
            Menues::TYPE_HIDDEN_PAGE => Lang::get('menues.form.type_hidden_page')
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
            $oAllMenu->where('is_published', '=', self::IS_PUBLISHED);
        }

        return $oAllMenu;
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
        $aItems = array(
            '-1' => ' --- ' . Lang::get('menues.form.select_menu') . ' --- ',
            0 => ' *** ' . Lang::get('menues.form.select_root_menu') . ' *** ',
        );
        $oAllMenu = self::getMenu(true)->orderBy('path')
            ->orderBy('pos')
            ->orderBy('title')
            ->get();


        $aTree  = self::buildTree($oAllMenu ? $oAllMenu->toArray() : array() );
        $oItems = array();

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
                'title' => Lang::get('layouts.layouts.dashboard'),
                'leftIcon' => '<i class="fa fa-dashboard"></i>',
                'rightIcon' => '<span class="fa arrow"></span>',
                'children' => array(
                    'dashboard' => array(
                        'title' => Lang::get('layouts.layouts.dashboard'),
                        'icon' => '<i class="fa fa-dashboard fa-fw"></i>',
                        'route' => 'admin.dashboard'
                    )
                ) 
            ),

            'news' => array(
                'title' => Lang::get('layouts.layouts.news'),
                'leftIcon' => '<i class="fa fa fa-trello fa-fw"></i>',
                'rightIcon' => '<span class="fa arrow"></span>',
                'children' => array(
                    'chapter_news' => array(
                        'title' => Lang::get('layouts.layouts.chapter_news'),
                        'icon' => '<i class="fa fa-dashboard"></i>',
                        'route' => 'admin.chapter'
                    ),

                    'news' => array(
                        'title' => Lang::get('layouts.layouts.news_articles'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'route' => 'admin.news'
                    )
                ) 
            ),

            'settings' => array(
                'title' => Lang::get('settings.form.settings'),
                'leftIcon' => '<i class="fa fa-cogs"></i>',
                'rightIcon' => '<span class="fa arrow"></span>',
                'children' => array(
                    'menu' => array(
                        'title' => Lang::get('layouts.layouts.menu') ,
                        'icon' => '<i class="fa fa-circle-o"></i>',
                        'route' => 'admin.menu'
                    ),

                    'user' => array(
                        'title' => Lang::get('layouts.layouts.user_management'),
                        'icon' => '<i class="fa fa-user"></i>',
                        'route' => 'admin.users'
                    ),

                    'settings' => array(
                        'title' => Lang::get('settings.form.settings'),
                        'icon' => '<i class="fa fa-cog"></i>',
                        'route' => 'admin.settings'
                    )
                )
            )
        );
    }


}
