<?php


// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::get('/', array('as' => 'home', 'uses' => 'Core\Face\IndexController@index') );
});