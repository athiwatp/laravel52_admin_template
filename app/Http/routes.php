<?php

// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index') );
});

/**
 * Middleware:
*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth'] ], function() {

    Route::get('/login', array('as' => 'admin.login', 'uses' => 'Admin\AuthController@index') );
    Route::post('/login', array('as' => 'admin.login.post', 'uses' => 'Admin\AuthController@login') );
    Route::post('/logout', array('as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout') );

    Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index') );

    // Settings resource
    Route::resource('settings', 'Admin\SettingsController');

    // Module to handle the Chapters the system
    Route::resource('chapter', 'Admin\ChaptersController');

    // Module to handle the News in the system
    Route::resource('news', 'Admin\NewsController');

    // Handle the Menu
    Route::resource('menu', 'Admin\NewsController');

    // User resource
    Route::resource('users', 'Admin\UsersController');

});




