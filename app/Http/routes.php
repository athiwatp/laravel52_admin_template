<?php

// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index') );
});

/**
 * Admin
*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin'] ], function() {
    Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index') );

    // Settings resource
    Route::resource('settings', 'Admin\SettingsController');

    // Module to handle the Chapters the system
    Route::get('chapter/gallery', array('as' => 'admin.chapter.gallery', 'uses' => 'Admin\ChaptersController@indexGallery'));

    // Chapters
    Route::resource('chapter', 'Admin\ChaptersController');

    // Module to handle the News in the system
    Route::resource('news', 'Admin\NewsController');

    // Handle the Menu
    Route::resource('menu', 'Admin\MenuesController');

    // User resource
    Route::resource('users', 'Admin\UsersController');

    // Module to handle the Video News in the system
    Route::resource('videoNews', 'Admin\VideoNewsController');

    // Module to handle the Pages in the system
    Route::resource('pages', 'Admin\PagesController');

    // Module to handle the Gallery in the system
    Route::resource('gallery', 'Admin\GalleryController');
});
/**
 * API
*/
Route::group(['prefix' => 'api/v1', 'middleware' => [/*'api',*/ 'auth:api']], function () {
    // Module to handle the News in the system
    Route::resource('news', 'Api\NewsController', ['only' => ['index', 'show']]);
    Route::resource('chapters', 'Api\NewsChapterController', ['only' => ['index', 'show']]);
    Route::resource('pages', 'Api\PagesController', ['only' => ['index', 'show']]);
    Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);
    Route::resource('menu', 'Api\MenuController', ['only' => ['index', 'show']]);
    Route::resource('video-news', 'Api\VideoNewsController', ['only' => ['index', 'show']]);
    Route::resource('menu', 'Api\MenuesController', ['only' => ['index', 'show']]);
    Route::resource('pages', 'Api\PagesController', ['only' => ['index', 'show']]);
    Route::resource('chapter', 'Api\ChaptersController', ['only' => ['index', 'show']]);
    Route::resource('gallery', 'Api\GalleryController', ['only' => ['index', 'show']]);
    Route::resource('users', 'Api\UsersController', ['only' => ['index', 'show']]);
});



