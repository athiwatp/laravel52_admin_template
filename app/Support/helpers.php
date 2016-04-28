<?php
use App\Helpers\File as cFile;
use App\Repositories\SettingsRepository;
use App\Repositories\CustomerReviewsRepository as CustomerReviews;
use App\Repositories\MenuesRepository as rMenu;
use App\Repositories\UsefulLinksRepository as UsefulLinks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

/**
 * Возвращает путь картинки.
 *
 * @param  string  $photo
 * @param  spring  $box
 * @return string
 */
if (! function_exists('get_file_url') ) {
    function get_file_url( $photo, $box = '' )
    {
        return ( $photo ? cFile::getImagePathURL($photo, $box) : '' );
    }
}

/**
 * Get current date
 *
 * @return string
 */
if (! function_exists('get_current_date') ) {
    function get_current_date()
    {
        $settings = new SettingsRepository();

        return Carbon::now()->format( $settings->getDateFormat() );
    }
}

/**
 * Get formatted date
 *
 * @return string
 */
if (! function_exists('get_formatted_date') ) {
    function get_formatted_date( $date )
    {
        $settings = new SettingsRepository();

        if (is_string($date) ) {
            $date = Carbon::parse($date);
        }

        return $date->format( $settings->getDateFormat() );
    }
}



/**
 * Limit the outputting for the list information
 *
*/
if (! function_exists('str_custom_limit') ) {
    function str_custom_limit( $str, $limit )
    {
        return str_limit( strip_tags($str), $limit);
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
 * Retrieve tags
 *
 * @return Array
 */
if (! function_exists('str_retrieve_tags') ) {
    function str_retrieve_tags( $str ) {
        return explode(',', $str);
    }
}

/**
 * Build cooperates
 *
 * @return String
*/
if (! function_exists('build_copyright') ) {
    function build_copyright() {
        return '&copy; ' . Carbon::now()->year . ' ' .
        'Всі права на матеріали, розміщені на сайті, належать Первомайській міській раді';
        // return 'Copyright &copy; Your Website ' .  Carbon::now()->year;
    }
}

/**
 * Site maker
 *
 * @return String
 */
if (! function_exists('build_site_maker_section') ) {
    function build_site_maker_section() {
        return 'Розробка та підтримка сайту — <a href="http://pervosoft.com" target="_blank">Pervosoft</a>';
    }
}

/**
 *
 *
*/
if (! function_exists('get_admin_email') ) {
    function get_admin_email() {
        $email = get_settings_data('admin_email');

        return (empty($email) ? '' : '<i class="fa fa-envelope-o"></i> <a href="mailto:' . $email . '">' . $email . '</a>');
    }
}

/**
 *
 *
 */
if (! function_exists('get_admin_phone') ) {
    function get_admin_phone() {
        $phone = get_settings_data('admin_phone');

        return $phone ? '<i class="fa fa-phone"></i> ' . $phone : '';
    }
}

/**
 *
 *
 */
if (! function_exists('get_useful_links') ) {
    function get_useful_links() {

        $links = new UsefulLinks();

        return $links->getUsefulLinks();
    }
}



/**
 * Returns settings data
*/
if ( ! function_exists('get_settings_data') ) {
    function get_settings_data( $item = null, $default = null ) {
        $settings = new SettingsRepository();

        return $settings->getSettings( $item, $default );
    }
}


/**
 * Returns settings data
 */
if ( ! function_exists('get_contact_address') ) {
    function get_contact_address( $default = '' ) {
        $s = get_settings_data('contact_address');

        return empty($s) ? $default : $s;
    }
}



if ( ! function_exists('get_search_data') ) {
    function get_search_data() {
        return Request::get('keywords');
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


/**
 * Build breadcrumbs for page
 *
 * @param {Object} $page
 *
 * @return {String}
 */
if ( ! function_exists('breadcrumbs_for_page') ) {

    function breadcrumbs_for_page( $page )
    {
        if (empty($page)) {
            return '';
        }

        if ( $page->menu ) {
//            dd($page->menu, $page->menu->parent_for_parent );
        }
    }
}


/**
 * Function to build the main menu
 *
 * @param int $menu_id
 *
 * @return String
 */
if (! function_exists('linked_sidebar_menu') ) {
    function linked_sidebar_menu($menu_id)
    {
        /**
         * Create main menu for the Front-end side
         */
        Menu::create('sidebar_menu', function($menu) use ($menu_id) {
            $menu->setPresenter('App\Helpers\Menu\SidebarPresenter');
            try {
                $repoMenu = new rMenu();
                $aTree = rMenu::buildTree( $repoMenu->getSidebarMenu($menu_id)->toArray() );
                foreach($aTree as $item) {
                    rMenu::createItem($item, $menu);
                }
            } catch (Exception $e) {}
        });

        return Menu::get('sidebar_menu');
    }
}

if ( ! function_exists('get_admin_contact') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function get_admin_contact()
    {
        return get_settings_data('contact');
    }
}

if ( ! function_exists('get_customer_reviews') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function get_customer_reviews()
    {
        $customerReviews = new CustomerReviews();

        if ( $customerReviews->getReviews()->count() > 0 ) {
            return $customerReviews->getReviews();
        }

        return array();
    }
}

if ( ! function_exists('get_site_name') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function get_site_name()
    {
        $data = get_settings_data('site_name');

        return $data;
    }
}

if ( ! function_exists('get_site_keywords') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function get_site_keywords()
    {
        $data = get_settings_data('meta_keywords');

        return $data;
    }
}

if ( ! function_exists('get_site_description') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function get_site_description()
    {
        $data = get_settings_data('meta_description');

        return $data;
    }
}

if ( ! function_exists('get_short_site_name') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function get_short_site_name()
    {
        return 'Admin.pervosoft.com';
    }
}



if ( ! function_exists('get_contact_coordinates') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function get_contact_coordinates()
    {
        return get_settings_data('contact_coordinates');
    }
}

if ( ! function_exists('get_facebook_activate') ) {
    /**
     * Return status Facebook (on\off).
     * @return string
     */
    function get_facebook_activate()
    {
        return ( get_settings_data('facebook_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_facebook_account') ) {
    /**
     * Return status Facebook (on\off).
     * @return string
     */
    function get_facebook_account()
    {
        return get_settings_data('facebook_account', '#');
    }
}

if ( ! function_exists('get_twitter_activate') ) {
    /**
     * Return status Twitter (on\off).
     * @return string
     */
    function get_twitter_activate()
    {
        return (get_settings_data('twitter_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_twitter_account') ) {
    /**
     * Return account Twitter.
     * @return string
     */
    function get_twitter_account()
    {
        return get_settings_data('twitter_account', '#');
    }
}

if ( ! function_exists('get_google_activate') ) {
    /**
     * Return status Google plus (on\off).
     * @return string
     */
    function get_google_activate()
    {
        return ( get_settings_data('google_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_google_account') ) {
    /**
     * Return account Google plus.
     * @return string
     */
    function get_google_account()
    {

        return get_settings_data('google_account', '#');
    }
}

if ( ! function_exists('get_linkedIn_activate') ) {
    /**
     * Return status linkedIn (on\off).
     * @return string
     */
    function get_linkedIn_activate()
    {
        return ( get_settings_data('linkedIn_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_linkedIn_account') ) {
    /**
     * Return account Twitter.
     * @return string
     */
    function get_linkedIn_account()
    {
        return get_settings_data('linkedIn_account', '#');
    }
}

if ( ! function_exists('get_vk_activate') ) {
    /**
     * Return status Vk (on\off).
     * @return string
     */
    function get_vk_activate()
    {
        return ( get_settings_data('vk_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_vk_account') ) {
    /**
     * Return account Vk.
     * @return string
     */
    function get_vk_account()
    {
        return get_settings_data('vk_account', '#');
    }
}

if ( ! function_exists('get_ok_activate') ) {
    /**
     * Return status Odnoklassniki (on\off).
     * @return string
     */
    function get_ok_activate()
    {
        return ( get_settings_data('ok_activate') === Config::get('constants.DONE_STATUS.SUCCESS') ? true : false );
    }
}

if ( ! function_exists('get_ok_account') ) {
    /**
     * Return account Odnoklassniki.
     * @return string
     */
    function get_ok_account()
    {
return get_settings_data('ok_account', '#');
    }
}

if ( ! function_exists('getOnButtonFacebook') ) {
    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonFacebook()
    {
        return get_settings_data('facebook_authorization');
    }
}

if ( ! function_exists('getOnButtonTwitter') ) {
    function getOnButtonTwitter()
    {
        return get_settings_data('twitter_authorization');
    }
}

if ( ! function_exists('getOnButtonGoogle') ) {
    function getOnButtonGoogle()
    {
        return get_settings_data('google_authorization');
    }
}

if ( ! function_exists('getOnButtonLinkedIn') ) {
    function getOnButtonLinkedIn()
    {
        return get_settings_data('linkedIn_authorization');
    }
}

if ( ! function_exists('getOnButtonOdnoklassniki') ) {
    function getOnButtonOdnoklassniki()
    {
        return get_settings_data('ok_authorization');
    }
}
