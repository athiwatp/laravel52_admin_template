<?php

namespace App\Listeners\Logs;

use App\Events\Logs\LogsWasChanged;
use App\Repositories\LogsRepository;
use Config, Auth, Lang;

class ChangedLogsListener
{
    /**
     * Logs repository
     *
     * @var Object (App\Repositories\LogsRepository)
     */
    protected $logs = null;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( LogsRepository $logs )
    {
        // Inject the logs instance
        $this->logs = $logs;
    }

    /**
     * Handle the event.
     *
     * @param  LogsWasChanged  $event
     * @return void
     */
    public function handle(LogsWasChanged $event)
    {
        $aParams = $event->aParams;
        $model = Lang::get('model.path');

        $comment     = array_key_exists('comment', $aParams) ? $aParams['comment'] : '---';
        $object_type = array_key_exists('object_type', $aParams) ? $aParams['object_type'] : '---';
        $title       = array_key_exists('title', $aParams) ? $aParams['title'] : '---';
        $sType       = array_key_exists('type', $aParams) ? $aParams['type'] : null;
        $object_id   = array_key_exists('object_id', $aParams) ? $aParams['object_id'] : '---';
        $user_id     = array_key_exists('user_id', $aParams) ? $aParams['user_id'] : Auth::id();

        $aModel = (array_key_exists($object_type, $model) ? $model[$object_type] : '');

        if ($sType === 'destroy') {
            $comment = $comment . ' [' . $aModel . '] [' . $title . ']';
        } else {
            $comment = $comment . ' [' . $aModel . ']';
        }

        $result = array(
            'object_id' => $object_id,
            'object_type' => $object_type,
            'comment' => $comment,
            'user_id' => $user_id
            );

        $log = $this->logs->store( $result );

        if ( $log ) {
            return $log;
        }
        return false;

    }
}
