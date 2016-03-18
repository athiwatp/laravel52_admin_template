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
    Route::resource('chapter', 'Admin\ChaptersController');

    // Module to handle the News in the system
    Route::resource('news', 'Admin\NewsController');

    // Handle the Menu
    Route::resource('menu', 'Admin\NewsController');
        Route::get('/gallery', array('as' => 'admin.chapter.gallery', 'uses' => 'Admin\ChaptersController@indexGallery') );

    // User resource
    Route::resource('users', 'Admin\UsersController');
    });

    Route::group(array('prefix' => 'pages'), function() {
        Route::get('/', array('as' => 'admin.pages', 'uses' => 'Admin\PagesController@index') );
        Route::get('/add', array('as' => 'admin.pages.create', 'uses' => 'Admin\PagesController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.pages.edit', 'uses' => 'Admin\PagesController@edit') );
        Route::post('/store', array('as' => 'admin.pages.store', 'uses' => 'Admin\PagesController@store') );
        Route::get('/destroy', array('as' => 'admin.pages.destroy', 'uses' => 'Admin\PagesController@destroy') );
    });


    Route::group(array('prefix' => 'gallery'), function() {
        Route::get('/', array('as' => 'admin.gallery', 'uses' => 'Admin\GalleryController@index') );
        Route::get('/add', array('as' => 'admin.gallery.create', 'uses' => 'Admin\GalleryController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.gallery.edit', 'uses' => 'Admin\GalleryController@edit') );
        Route::post('/store', array('as' => 'admin.gallery.store', 'uses' => 'Admin\GalleryController@store') );
        Route::get('/destroy', array('as' => 'admin.gallery.destroy', 'uses' => 'Admin\GalleryController@destroy') );

});

/**
 * API
*/
Route::group(['prefix' => 'api/v1', 'middleware' => [/*'api',*/ 'auth:api']], function () {
    // Module to handle the News in the system
    Route::resource('news', 'Api\NewsController', ['only' => ['index', 'show']]);
});



