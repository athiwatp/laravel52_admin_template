<?php

// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/redirect/{provider}', 'Core\SocialAuthController@redirect');

    Route::get('/callback/{provider}', 'Core\SocialAuthController@callback');

    // Home page
    Route::get('/', array('as' => 'home', 'uses' => 'Core\Face\IndexController@index') );

    // Page viewer
    Route::get('/s/{url}', array('as' => 'page-url', 'uses' => 'Core\Face\PagesController@show') );

    // Menu viewer
    Route::get('/m/{url}', array('as' => 'menu-url', 'uses' => 'Core\Face\MenuController@show') );

    // News viewer
    Route::get('/n/{url}', array('as' => 'news-url', 'uses' => 'Core\Face\NewsController@show') );

    // News list
    Route::get('/news', array('as' => 'news-list', 'uses' => 'Core\Face\NewsController@index') );
});

/**
 * Admin
*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin'] ], function() {
    Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'Core\Admin\DashboardController@index') );

    // Settings resource
    Route::resource('settings', 'Core\Admin\SettingsController');

    // Module to handle the Chapters the system
    Route::get('chapter/gallery', array('as' => 'admin.chapter.gallery', 'uses' => 'Core\Admin\ChaptersController@indexGallery'));

    // Chapters
    Route::resource('chapter', 'Core\Admin\ChaptersController');

    // Module to handle the News in the system
    Route::resource('news', 'Core\Admin\NewsController');

    // Handle the Menu
    Route::resource('menu', 'Core\Admin\MenuesController');

    // Handle the Menu
    Route::resource('customerReviews', 'Core\Admin\CustomerReviewsController');

    // User resource
    Route::resource('users', 'Core\Admin\UsersController');

    // Module to handle the Video News in the system
    Route::resource('videoNews', 'Core\Admin\VideoNewsController');

    // Module to handle the Pages in the system
    Route::resource('pages', 'Core\Admin\PagesController');

    // Module to handle the Gallery in the system
    Route::resource('gallery', 'Core\Admin\GalleryController');
});

/**
 * API
*/
Route::group(['prefix' => 'api/v1', 'middleware' => [/*'api',*/ 'auth:api']], function () {
    // Module to handle the News in the system
    Route::resource('news', 'Core\Api\NewsController', ['only' => ['index', 'show']]);
    Route::resource('chapters', 'Core\Api\ChapterController', ['only' => ['index', 'show']]);
    Route::resource('pages', 'Core\Api\PagesController', ['only' => ['index', 'show']]);
    Route::resource('customerReviews', 'Core\Api\CustomerReviewsController', ['only' => ['index', 'show']]);
    Route::resource('users', 'Core\Api\UsersController', ['only' => ['index', 'show']]);
    Route::resource('menu', 'Core\Api\MenuController', ['only' => ['index', 'show']]);
    Route::resource('video-news', 'Core\Api\VideoNewsController', ['only' => ['index', 'show']]);
    Route::resource('pages', 'Core\Api\PagesController', ['only' => ['index', 'show']]);
    // Route::resource('chapters-gallery', 'Api\GalleryChaptersController', ['only' => ['index', 'show']]);
    Route::resource('gallery', 'Core\Api\GalleryController', ['only' => ['index', 'show']]);
    Route::resource('users', 'Core\Api\UsersController', ['only' => ['index', 'show']]);



});



