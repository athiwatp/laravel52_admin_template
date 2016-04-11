<?php

use App\Helpers\File as cFile;
use App\Repositories\SettingsRepository;
use App\Repositories\MenuesRepository;

if (! function_exists('get_file_url') ) {

    /**
     * Возвращает путь картинки.
     *
     * @param  string  $photo 
     * @param  spring  $box
     * @return string
     */
    function get_file_url( $photo, $box )
    {
        return ( $photo ? cFile::getImagePathURL($photo, $box) : '' );
    }
}

if ( ! function_exists('getAdminContact') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function getAdminContact()
    {
        $data = get_settings_data();

        return array_key_exists('contact', $data) ? $data['contact'] : '';
    }
}

if ( ! function_exists('getContactAddress') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function getContactAddress()
    {
        $data = get_settings_data();

        return array_key_exists('contact_address', $data) ? $data['contact_address'] : '';
    }
}

if ( ! function_exists('getCoordinates') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function getCoordinates()
    {
        $data = get_settings_data();

        return array_key_exists('contact_coordinates', $data) ? $data['contact_coordinates'] : '';
    }
}

if ( ! function_exists('getSateName') ) {
    /**
     * Returns the site name with the settings.
     *
     * @return string
     */

    function getSateName()
    {
        $data = get_settings_data();

        return array_key_exists('site_name', $data) ? $data['site_name'] : '';
    }
}

if ( ! function_exists('getAdminEmail') ) {
    /**
     * Returns the email with the settings.
     *
     * @return string
     */

    function getAdminEmail()
    {
        $data = get_settings_data();

        return array_key_exists('admin_email', $data) ? $data['admin_email'] : '';
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

        return $settings->getSettings()['facebook_authorization'];
    }
}

if ( ! function_exists('getOnButtonTwitter') ) {

    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonTwitter()
    {
        $settings = new SettingsRepository();

        return $settings->getSettings()['twitter_authorization'];
    }
}

if ( ! function_exists('getOnButtonGoogle') ) {

    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonGoogle()
    {
        $settings = new SettingsRepository();

        return $settings->getSettings()['google_authorization'];
    }
}

if ( ! function_exists('getOnButtonLinkedIn') ) {

    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonLinkedIn()
    {
        $settings = new SettingsRepository();

        return $settings->getSettings()['linkedIn_authorization'];
    }
}


if ( ! function_exists('main_menu') ) {

    function main_menu()
    {
        $menu = new MenuesRepository();
        return ;
    }
}