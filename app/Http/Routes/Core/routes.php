<?php

// Entry point
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/redirect/{provider}', 'Core\SocialAuthController@redirect');

    Route::get('/callback/{provider}', 'Core\SocialAuthController@callback');

    Route::get('/subscription/activate/{code}',  ['as' => 'subscription-activate', 'uses' => 'Core\Face\SubscribersController@activate']);
    Route::get('/subscription/deactivate/{code}',  ['as' => 'subscription-deactivate', 'uses' => 'Core\Face\SubscribersController@deactivate']);
    Route::get('/subscription/thanks/{code}',  ['as' => 'subscription-thanks', 'uses' => 'Core\Face\SubscribersController@thanks']);
    Route::get('/subscription/error',  ['as' => 'subscription-activation-error', 'uses' => 'Core\Face\SubscribersController@error']);

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
    // Contact viewer
    Route::get('/contact', array('as' => 'contact', 'uses' => 'Core\Face\ContactController@show'));

    // Gallery viewer
    Route::get('/g/{id}', array('as' => 'gallery-url', 'uses' => 'Core\Face\GalleryController@show') );

    // Gallery list
    Route::get('/gallery', array('as' => 'gallery-list', 'uses' => 'Core\Face\GalleryController@index') );

    // Gallery viewer
    Route::get('/v/{id}', array('as' => 'video-url', 'uses' => 'Core\Face\VideoController@show') );

    // Gallery list
    Route::get('/video', array('as' => 'video-list', 'uses' => 'Core\Face\VideoController@index') );

    // Search list
    Route::get('/search', array('as' => 'search', 'uses' => 'Core\Face\SearchController@index') );

    // Announce list
    Route::get('/a/{id}', array('as' => 'announce-show', 'uses' => 'Core\Face\AnnouncementsController@show') );
    Route::get('/announcements', array('as' => 'announce-list', 'uses' => 'Core\Face\AnnouncementsController@index') );
});

Route::group(['prefix' => 'print', 'middleware' => ['web'] ], function() {
    Route::get('/n/{url}', array('as' => 'print-news-url', 'uses' => 'Core\Face\PrintController@showNews') );
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

    // Module to handle the Chapters the system
    Route::get('chapter/useful-links', array('as' => 'admin.chapter.usefulLinks', 'uses' => 'Core\Admin\ChaptersController@indexUsefulLinks'));

    // Handle the Announcements
    Route::get('chapter/announcements', array('as' => 'admin.chapter.announcements', 'uses' => 'Core\Admin\ChaptersController@indexAnnouncements'));

    // Handle the Logs
    Route::get('logs', array('as' => 'admin.logs', 'uses' => 'Core\Admin\LogsController@index'));

    // Chapters
    Route::resource('chapter', 'Core\Admin\ChaptersController');

    // Module to handle the News in the system
    Route::resource('news', 'Core\Admin\NewsController');

    // Handle the Subscribers
    Route::resource('subscribers', 'Core\Admin\SubscribersController');

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

    // Handle the Announcements
    Route::resource('announcements', 'Core\Admin\AnnouncementsController');

    // Files list
    Route::get('/files', array('as' => 'files-list', 'uses' => 'Core\Admin\FilesController@index') );
    Route::post('/files/upload', array('as' => 'file-upload', 'uses' => 'Core\Admin\FilesController@store') );
    Route::get('/files/thanks', array('as' => 'file-thanks-page', 'uses' => 'Core\Admin\FilesController@thanks') );

    // Handle the useful links
    Route::resource('usefulLinks', 'Core\Admin\UsefulLinksController');

});

/**
 * API
*/
Route::group(['prefix' => 'api/v1', 'middleware' => [/*'api',*/ 'auth:api']], function () {
    // Module to handle the News in the system
    Route::resource('news', 'Core\Api\NewsController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('chapters', 'Core\Api\ChapterController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('pages', 'Core\Api\PagesController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('customerReviews', 'Core\Api\CustomerReviewsController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('users', 'Core\Api\UsersController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('menu', 'Core\Api\MenuController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('video-news', 'Core\Api\VideoNewsController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('pages', 'Core\Api\PagesController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('gallery', 'Core\Api\GalleryController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('users', 'Core\Api\UsersController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('subscriber', 'Core\Api\SubscriberController', ['only' => ['store']]);
    Route::resource('subscribers', 'Core\Api\SubscriberController', ['only' => ['index', 'destroy']]);
    Route::resource('announcements', 'Core\Api\AnnouncementsController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('usefulLinks', 'Core\Api\UsefulLinksController', ['only' => ['index', 'show', 'destroy']]);
    Route::resource('logs', 'Core\Api\LogsController', ['only' => ['index']]);

});



    // /// TEMPORARY SECTION: WILL BE REMOVED 

    // Route::get('/pages/sync/{start?}', array('as' => 'admin.pages.sync', 'before' => 'auth', 'uses' => 'Core\Admin\PagesController@sync'));

    // Route::get('/news/sync/{start?}', array('as' => 'admin.news.sync', 'before' => 'auth', 'uses' => 'Core\Admin\NewsController@sync'));

    // Route::get('/announcements/sync/{start?}', array('as' => 'admin.announcements.sync', 'before' => 'auth', 'uses' => 'Core\Admin\AnnouncementsController@sync'));

    // ///
