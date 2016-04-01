<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Files\FileWasLoaded' => [
            'App\Listeners\Files\LoadFileListener',
        ],

        'App\Events\Files\FileWasRemoved' => [
            'App\Listeners\Files\RemoveFileListener',
        ],

        'App\Events\Content\ContentWasSaved' => [
            'App\Listeners\Content\SaveContentListener',
        ],

        'App\Events\Url\UrlWasChanged' => [
            'App\Listeners\Url\ChangeUrlListener',
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
