<?php

namespace App\Listeners\Files;

use App\Events\Files\FileWasRemoved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveFileListener
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
     * @param  FileWasRemoved  $event
     * @return void
     */
    public function handle(FileWasRemoved $event)
    {
        //
    }
}
