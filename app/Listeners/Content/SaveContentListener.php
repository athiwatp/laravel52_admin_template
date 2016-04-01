<?php

namespace App\Listeners\Content;

use App\Events\Content\ContentWasSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveContentListener
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
     * @param  ContentWasSaved  $event
     * @return void
     */
    public function handle(ContentWasSaved $event)
    {
        //
    }
}
