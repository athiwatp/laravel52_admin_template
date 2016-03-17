<?php

// Entry point
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index') );


Route::group(['prefix' => 'admin'], function() {

    Route::get('/login', array('as' => 'admin.login', 'uses' => 'Admin\AuthController@index') );
    Route::post('/login', array('as' => 'admin.login.post', 'uses' => 'Admin\AuthController@login') );
    Route::post('/logout', array('as' => 'admin.logout', 'uses' => 'Admin\AuthController@logout') );

    Route::get('/', array('as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index') );

    Route::group(array('prefix' => 'settings'), function() {
        Route::get('/', array('as' => 'admin.settings', 'uses' => 'Admin\SettingsController@index') );
        Route::post('/store', array('as' => 'admin.settings.store', 'uses' => 'Admin\SettingsController@store') );
    });
    
    Route::group(array('prefix' => 'chapter'), function() {
        Route::get('/', array('as' => 'admin.chapter', 'uses' => 'Admin\ChaptersController@index') );
        Route::get('/add', array('as' => 'admin.chapter.create', 'uses' => 'Admin\ChaptersController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.chapter.edit', 'uses' => 'Admin\ChaptersController@edit') );
        Route::post('/store', array('as' => 'admin.chapter.store', 'uses' => 'Admin\ChaptersController@store') );
        Route::get('/destroy', array('as' => 'admin.chapter.destroy', 'uses' => 'Admin\ChaptersController@destroy') );
    });

    Route::group(array('prefix' => 'news'), function() {
        Route::get('/', array('as' => 'admin.news', 'uses' => 'Admin\NewsController@index') );
        Route::get('/add', array('as' => 'admin.news.create', 'uses' => 'Admin\NewsController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.news.edit', 'uses' => 'Admin\NewsController@edit') );
        Route::post('/store', array('as' => 'admin.news.store', 'uses' => 'Admin\NewsController@store') );
        Route::get('/destroy', array('as' => 'admin.news.destroy', 'uses' => 'Admin\NewsController@destroy') );
    });

    Route::group(array('prefix' => 'menu'), function() {
        Route::get('/', array('as' => 'admin.menu', 'uses' => 'Admin\MenuesController@index') );
        Route::get('/add', array('as' => 'admin.menu.create', 'uses' => 'Admin\MenuesController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.menu.edit', 'uses' => 'Admin\MenuesController@edit') );
        Route::post('/store', array('as' => 'admin.menu.store', 'uses' => 'Admin\MenuesController@store') );
        Route::get('/destroy', array('as' => 'admin.menu.destroy', 'uses' => 'Admin\MenuesController@destroy') );
    });

    Route::group(array('prefix' => 'users'), function() {
        Route::get('/', array('as' => 'admin.users', 'uses' => 'Admin\UsersController@index') );
        Route::get('/add', array('as' => 'admin.user.create', 'uses' => 'Admin\UsersController@create') );
        Route::get('/edit/{id?}', array('as' => 'admin.user.edit', 'uses' => 'Admin\UsersController@edit') );
        Route::post('/store', array('as' => 'admin.user.store', 'uses' => 'Admin\UsersController@store') );
        Route::get('/destroy', array('as' => 'admin.user.destroy', 'uses' => 'Admin\UsersController@destroy') );
    });

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
