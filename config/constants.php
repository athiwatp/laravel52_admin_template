<?php
/**
 * Set of Application constants
 *
 * @project Laravel Templater
 * @author Sergey Donchenko, <sergey.donchenko@gmail.com>
*/
return [
    /**
     * Describes the resource types
     *
     * @var Array
    */
    'RESOURCES' => [
        'NEWS' => 'news',
        'PHOTO_GALLERY' => 'photo_gallery',
        'VIDEO' => 'video',
        'CHAPTER' => 'chapter'
    ],

    /**
     * Describes the done status for the operations
     *
     * @var Array
    */
    'DONE_STATUS' => [
        'SUCCESS' => '1',
        'FAILURE' => '0'
    ],

    /**
     * Describes the resource types
     *
     * @var Array
    */
    'TYPE_MENU' => [
        'MAIN' => 'M',
        'SIDE' => 'S',
        'FOOTER' => 'F',
        'HIDDEN_PAGE' => 'H'
    ],

    /**
     * Describes the resource types
     *
     * @var Array
    */
    'USERS' => [
        'ADMIN' => '1',
        'USER' => '0',
        'IS_VERIFIED' => '1',
        'NOT_VERIFIED' => '0'
    ],

    /**
     * Describes the resource types
     *
     * @var Array
    */
    'GALLERY' => [
        'PHOTO' => 'P',
        'VIDEO' => 'V'
    ],

    /**
     * Describes the resource types
     *
     * @var Array
    */
    'URL_HISTORY' => [
        'TYPE_MENU' => 'menu',
        'TYPE_NONE' => 'none',
        'TYPE_PAGE' => 'page',
        'TYPE_NEWS' => 'news'
    ],

    /**
     * Describes the resource types
     *
     * @var Array
    */
    'CHAPTER' => [
        'CHAPTER' => '0',
        'GALLERY' => '1',
        'JOB' => '2'
    ]

];