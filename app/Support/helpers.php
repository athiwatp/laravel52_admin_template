<?php

use App\Helpers\File as cFile;
use App\Repositories\SettingsRepository;
use App\Repositories\MenuesRepository as rMenu;
use Carbon\Carbon;
use Lang;

/**
 * Возвращает путь картинки.
 *
 * @param  string  $photo
 * @param  spring  $box
 * @return string
 */
if (! function_exists('get_file_url') ) {

    function get_file_url( $photo, $box )
    {
        return ( $photo ? cFile::getImagePathURL($photo, $box) : '' );
    }
}

/**
 * Build cooperates
 *
 * @return String
*/
if (! function_exists('build_copyright') ) {
    function build_copyright() {
        return 'Copyright &copy; Your Website ' .  Carbon::now()->year;
    }
}

/**
 * Returns formated date
 *
 * @param String $date
 * @param Boolean $time - show time
 *
 * @return String
 */
if (! function_exists('get_formatted_date') ) {
    function get_formatted_date( $date, $time = false ) {
        $dt = Carbon::parse( $date );
        $months = Lang::get('datetime.months');

        return $dt->day . ' ' .
            (array_key_exists($dt->month, $months) ? $months[$dt->month] : '') . ' ' .
            $dt->year .
            (
                $time && $dt->minute > 0  ?
                    ' ' . $dt->minute . ':' . $dt->minute
                    : ''
            );
    }
}


/**
 * Function to build the main menu
 *
 * @doc http://sky.pingpong-labs.com/docs/2.0/menus
 * @return String
*/
if (! function_exists('main_menu') ) {

    function main_menu()
    {
        /**
         * Create main menu for the Front-end side
         */
        Menu::create('main', function($menu) {
            $menu->setPresenter('App\Helpers\Menu\MainPresenter');

            try {
                $repoMenu = new rMenu();

                $aTree = rMenu::buildTree( $repoMenu->getMainMenu()->toArray() );

                foreach($aTree as $item) {
                    rMenu::createItem($item, $menu);
                }
            } catch (Exception $e) {}
        });

        return Menu::get('main');
    }
}


/**
 * Function to build the main menu
 *
 * @return String
 */
if (! function_exists('footer_menu') ) {

    function footer_menu()
    {
        /**
         * Create main menu for the Front-end side
         */
        Menu::create('footer', function($menu) {
            $menu->setPresenter('App\Helpers\Menu\FooterPresenter');

            try {
                $repoMenu = new rMenu();

                $aTree = rMenu::buildTree( $repoMenu->getFooterMenu()->toArray() );

                foreach($aTree as $item) {
                    rMenu::createItem($item, $menu);
                }

            } catch (Exception $e) {}
        });

        return Menu::get('footer');
    }
}


/**
 * Function to build the main menu
 *
 * @return String
 */
if (! function_exists('sidebar_menu') ) {

    function sidebar_menu()
    {
        /**
         * Create main menu for the Front-end side
         */
        Menu::create('sidebar_menu', function($menu) {
            $menu->setPresenter('App\Helpers\Menu\SidebarPresenter');

            try {
                $repoMenu = new rMenu();

                $aTree = rMenu::buildTree( $repoMenu->getSidebarMenu()->toArray() );

                foreach($aTree as $item) {
                    rMenu::createItem($item, $menu);
                }

            } catch (Exception $e) {}
        });

        return Menu::get('sidebar_menu');
    }
}

if ( ! function_exists('getSocialButtons') ) {


    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonFacebook()
    {
        $settings = new SettingsRepository();

        return '';
//        return $settings->getSocialButtons()['facebook_authorization'];
    }

    function getOnButtonTwitter()
    {
        $settings = new SettingsRepository();
        return '';
//     return $settings->getSocialButtons()['twitter_authorization'];
    }

    function getOnButtonGoogle()
    {
        $settings = new SettingsRepository();
        return '';

//        return $settings->getSocialButtons()['google_authorization'];
    }

    function getOnButtonLinkedIn()
    {
        $settings = new SettingsRepository();

        return '';
        //return $settings->getSocialButtons()['linkedIn_authorization'];
    }
}


//if ( ! function_exists('main_menu') ) {
//
//    function main_menu()
//    {
//        $menu = new MenuesRepository();
//        return ;
//    }
//}