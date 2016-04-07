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

if ( ! function_exists('getSocialButtons') ) {


    /**
     * Возвращает статус кнопки авторизации соцсетей.
     * @return string
     */
    function getOnButtonFacebook()
    {
        $settings = new SettingsRepository();

        return $settings->getSocialButtons()['facebook_authorization'];
    }

    function getOnButtonTwitter()
    {
        $settings = new SettingsRepository();

        return $settings->getSocialButtons()['twitter_authorization'];
    }

    function getOnButtonGoogle()
    {
        $settings = new SettingsRepository();

        return $settings->getSocialButtons()['google_authorization'];
    }

    function getOnButtonLinkedIn()
    {
        $settings = new SettingsRepository();

        return $settings->getSocialButtons()['linkedIn_authorization'];
    }
}


if ( ! function_exists('main_menu') ) {

    function main_menu()
    {
        $menu = new MenuesRepository();
        return ;
    }
}