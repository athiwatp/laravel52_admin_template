<?php

// Entry point
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index') );


Route::group(['prefix' => 'admin'], function() {

    Route::get('/login', array('as' => 'admin.login', 'uses' => 'Admin\AuthController@index') );
    Route::post('/login', array('as' => 'admin.login.post', 'uses' => 'Admin\AuthController@login') );

    Route::get('/dashboard', array('as' => 'admin.dashboard', 'uses' => 'Admin\DashboardController@index') );
    Route::get('/settings', array('as' => 'admin.settings', 'uses' => 'Admin\SettingsController@index') );

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
