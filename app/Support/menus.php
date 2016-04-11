<?php

use App\Repositories\MenuesRepository;
use Pingpong\Menus\MenuItem;

/**
 * Create Dasboard menu
 */
if (Auth::check()) {
    Menu::create('leftAdmin', function($menu) {
        $menu->setPresenter('App\Helpers\Menu\AdminPresenter');

        foreach(MenuesRepository::getAdminSiderbarMenu() as $menuItem) {
            $aSubMenu = array_key_exists('children', $menuItem) ? $menuItem['children'] : array();
            if ( isset($aSubMenu) && $aSubMenu != null ) {
                $menu->dropdown( $menuItem['leftIcon'] . ' ' . $menuItem['title'] . $menuItem['rightIcon'], function(MenuItem $sub) use ($aSubMenu) {
                    foreach($aSubMenu as $subItem) {
                        $sub->route( $subItem['route'] , $subItem['icon'] . ' ' . $subItem['title']);
                    }
                });
            } else {
                $menu->route( $menuItem['route'], $menuItem['leftIcon'] . ' ' . $menuItem['title']);
            }
        }
    });
}


// Menu::create('footer', function($menu) {
//     $menu->setPresenter('FooterPresenter');

//     try {
//         $aTree = MenuesRepository::buildTree(MenuesRepository::getFooterMenu()->toArray());
//         foreach($aTree as $item) {
//             // dd( $menu );
//             MenuesRepository::createItem($item, $menu);
//         }
//     } catch (Exception $e) {}
// });


// class FooterPresenter extends NavbarPresenter
// {
//     /**
//      * {@inheritdoc }
//      */
//     public function getOpenTagWrapper()
//     {
//         return  PHP_EOL . '<ul class="footer-nav">' . PHP_EOL;
//     }
// }


// /**
// * Create main menu for the Front-end side
// */
// Menu::create('main', function($menu) {
//     $menu->setPresenter('MainPresenter');
//     try {
//         $aTree = MenuesRepository::buildTree(MenuesRepository::getMainMenu()->toArray());
        
//         foreach($aTree as $item) {
//             MenuesRepository::createItem($item, $menu);
//         }
//     } catch (Exception $e) {}
// });


// class MainPresenter extends NavbarPresenter
// {
//     /**
//      * {@inheritdoc }
//      */
//     public function getOpenTagWrapper()
//     {
//         return  PHP_EOL . '<ul class="nav nav-justified">' . PHP_EOL;
//     }
// }
// // ------ end of main menu ------ //

// // Create sidebar menu
// Menu::create('navbar', function($menu) {
//     $menu->setPresenter('LeftSidebarPresenter');

//     try {
        
//         $aTree = MenuesRepository::buildTree(MenuesRepository::getVerticalMenu()->toArray());
        
//         foreach($aTree as $item) {
//             MenuesRepository::createItem($item, $menu);
//         }
//     } catch (Exception $e) {}
// });

// class LeftSidebarPresenter extends NavbarPresenter
// {
//     /**
//      * {@inheritdoc }
//      */
//     public function getOpenTagWrapper()
//     {
//         return  PHP_EOL . '<ul class="nav nav-tree">' . PHP_EOL;
//     }

//     /**
//      * {@inheritdoc }
//      */
//     public function getMenuWithDropDownWrapper($item)
//     {
//         return '<li class="'. $this->getActiveStateOnChild($item, ' active') .'">'
//             .  '<a>'.$item->getIcon().'' . $item->title . '</a>'
//             .  '<ul> '
//             .   $this->getChildMenuItems($item) . ' '
//             .  '</ul>'
//             . '</li>'
//             . PHP_EOL;
//         ;
//     }

//     /**
//      * Get multilevel menu wrapper.
//      *
//      * @param \Pingpong\Menus\MenuItem $item
//      * @return string`
//      */
//     public function getMultiLevelDropdownWrapper($item)
//     {
//         return '<li class="dropdown'. $this->getActiveStateOnChild($item, ' active') .'">
//                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
//                         '.$item->getIcon().' '.$item->title.'
//                         <b class="caret pull-right right-caret"></b>
//                     </a>
//                     <ul class="dropdown-menu pull-right">
//                         '.$this->getChildMenuItems($item).'
//                     </ul>
//                 </li>'
//         . PHP_EOL;
//         ;
//     }
// }
