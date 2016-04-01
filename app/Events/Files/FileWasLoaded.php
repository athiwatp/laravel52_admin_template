<?php namespace App\Events\Files;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FileWasLoaded extends Event
{
    use SerializesModels;

    /**
     * Set of parameters about the uploaded resource
     *
     * @var Array
    */
    public $aParams = [];

    /**
     * Create a new event instance.
     */
    public function __construct( $params )
    {
        $this->aParams = $params;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
