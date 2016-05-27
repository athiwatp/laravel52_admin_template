<?php

namespace App\Events\Mail;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMail extends Event
{
    use SerializesModels;

    // Consts
    const SUBSCRIBER_ACTIVATION   = 'subscribers.activation';
    const SUBSCRIBER_ACTIVATION_SUCCESS   = 'subscribers.activation_success';
    const SUBSCRIBER_DEACTIVATION = 'subscribers.deactivation';
    const SUBSCRIBER_DEACTIVATION_SUCCESS = 'subscribers.deactivation_success';
    const SUBSCRIBER_LIST_OF_UPDATES = 'subscribers.list_of_updates';

    /**
     * Set of parameters about the uploaded resource
     *
     * @var Array
     */
    public $aParams = [];

    /**
     * Create a new event instance.
     *
     * @param Array $params - the event params
     *
     * @return void
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
