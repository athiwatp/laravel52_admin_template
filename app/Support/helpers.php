<?php
use App\Helpers\File as cFile;
use App\Repositories\SettingsRepository;
use App\Repositories\MenuesRepository as rMenu;
use Carbon\Carbon;
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
 * build youtube preview url
 *
 * @return String
 */
if (! function_exists('get_youtube_preview') ) {
    function get_youtube_preview( $url ) {
        return 'http://img.youtube.com/vi/' . cScreenshot::getItems( $url ) .  '/hqdefault.jpg';
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

if ( ! function_exists('getAdminContact') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getAdminContact()
    {
        $settings = new SettingsRepository();

       return $settings->getSettings()['contact'];
    }
}

if ( ! function_exists('getContactCoordinates') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getContactCoordinates()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['contact_coordinates'] ? $settings->getSettings()['contact_coordinates'] : false);
    }
}

if ( ! function_exists('getFacebookActivate') ) {
    /**
     * Return status Facebook (on\off).
     * @return string
     */
    function getFacebookActivate()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['facebook_activate'] === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('getFacebookAccount') ) {
    /**
     * Return status Facebook (on\off).
     * @return string
     */
    function getFacebookAccount()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['facebook_account'] ? $settings->getSettings()['facebook_account'] : '#' );
    }
}

if ( ! function_exists('getTwitterActivate') ) {
    /**
     * Return status Twitter (on\off).
     * @return string
     */
    function getTwitterActivate()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['twitter_activate'] === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('getTwitterAccount') ) {
    /**
     * Return account Twitter.
     * @return string
     */
    function getTwitterAccount()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['twitter_account'] ? $settings->getSettings()['twitter_account'] : '#' );
    }
}

if ( ! function_exists('getGoogleActivate') ) {
    /**
     * Return status Google plus (on\off).
     * @return string
     */
    function getGoogleActivate()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['google_activate'] === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('getGoogleAccount') ) {
    /**
     * Return account Google plus.
     * @return string
     */
    function getGoogleAccount()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['google_account'] ? $settings->getSettings()['google_account'] : '#' );
    }
}

if ( ! function_exists('getLinkedInActivate') ) {
    /**
     * Return status linkedIn (on\off).
     * @return string
     */
    function getLinkedInActivate()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['linkedIn_activate'] === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('getLinkedInAccount') ) {
    /**
     * Return account Twitter.
     * @return string
     */
    function getLinkedInAccount()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['linkedIn_account'] ? $settings->getSettings()['linkedIn_account'] : '#' );
    }
}

if ( ! function_exists('getVkActivate') ) {
    /**
     * Return status Vk (on\off).
     * @return string
     */
    function getVkActivate()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['vk_activate'] === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('getVkAccount') ) {
    /**
     * Return account Vk.
     * @return string
     */
    function getVkAccount()
    {
        $settings = new SettingsRepository();

       return ( $settings->getSettings()['vk_account'] ? $settings->getSettings()['vk_account'] : '#' );
    }
}

if ( ! function_exists('getOnButtonFacebook') ) {
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
}

if ( ! function_exists('getOnButtonTwitter') ) {
    function getOnButtonTwitter()
    {
        $settings = new SettingsRepository();
        return '';
//     return $settings->getSocialButtons()['twitter_authorization'];
    }
}

if ( ! function_exists('getOnButtonGoogle') ) {
    function getOnButtonGoogle()
    {
        $settings = new SettingsRepository();
        return '';
//        return $settings->getSocialButtons()['google_authorization'];
    }
}

if ( ! function_exists('getOnButtonLinkedIn') ) {
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