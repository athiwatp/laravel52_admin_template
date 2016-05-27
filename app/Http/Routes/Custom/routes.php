<?php


// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::get('/', array('as' => 'home', 'uses' => 'Core\Face\IndexController@index') );

    // News viewer
    Route::get('/news', array('as' => 'news-index', 'uses' => 'Custom\Face\NewsController@index') );
    Route::get('/n/{url}', array('as' => 'news-url', 'uses' => 'Custom\Face\NewsController@show') );
    Route::get('/np/{url}', array('as' => 'news-forprint', 'uses' => 'Custom\Face\NewsController@forprint') );

    // Page viewer
    Route::get('/s/{url}', array('as' => 'page-url', 'uses' => 'Custom\Face\PagesController@show') );

    // Menu viewer
    Route::get('/m/{url}', array('as' => 'menu-url', 'uses' => 'Custom\Face\MenuController@show') );

    // Gallery viewer
    Route::get('/g/{id}', array('as' => 'gallery-url', 'uses' => 'Custom\Face\GalleryController@show') );
    Route::get('/gallery', array('as' => 'gallery-list', 'uses' => 'Custom\Face\GalleryController@index') );

    // Gallery viewer
    Route::get('/v/{id}', array('as' => 'video-url', 'uses' => 'Custom\Face\VideoController@show') );
    Route::get('/video', array('as' => 'video-list', 'uses' => 'Custom\Face\VideoController@index') );

    // Announce viewer
    Route::get('/a/{id}', array('as' => 'announce-show', 'uses' => 'Custom\Face\AnnounceController@show') );
    Route::get('/announce', array('as' => 'announce-list', 'uses' => 'Custom\Face\AnnounceController@index') );

    // Search list
    Route::get('/search', array('as' => 'search', 'uses' => 'Custom\Face\SearchController@index') );
});

// Route::group(['prefix' => 'api/v1', 'middleware' => [/*'api',*/ 'auth:api']], function () {
//     Route::resource('announcements', 'Custom\Api\AnnouncementsController', ['only' => ['index', 'show', 'destroy']]);
//     Route::resource('news', 'Custom\Api\NewsController', ['only' => ['index', 'show', 'destroy']]);
//     Route::resource('gallery', 'Custom\Api\GalleryController', ['only' => ['index', 'show', 'destroy']]);
// });