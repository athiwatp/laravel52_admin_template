<?php

namespace App\Listeners\Url;

use App\Events\Url\UrlWasChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeUrlListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UrlWasChanged  $event
     * @return void
     */
    public function handle(UrlWasChanged $event)
    {
        //
    }
}
