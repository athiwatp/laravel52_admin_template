<?php namespace App\Repositories;

use App\Models\Logs;
use Illuminate\Http\Request;

class LogsRepository extends BaseRepository {

    /**
     * Create a new Message instance
     *
     * @param App\Models\Logs $logs
     *
     * @return void
     */
    public function __construct( Logs $logs )
    {
        // Logs Model
        $this->model = $logs;
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Logs $logs
     *
     * @return Collection of Object
     */
    public function index()
    {
        return $this->model->all();
    }


    /**
     * Create or update Message
     *
     * @param App\Models\Logs $logs
     *
     * @return
     */
    public function saveLogs( $logs, $inputs )
    {
        $logs->comment      = $inputs['comment'];
        $logs->object_type  = $inputs['object_type'];
        $logs->object_id    = $inputs['object_id'];
        $logs->user_id      = $inputs['user_id'];

        if ( $logs->save() ) {
            return $logs;
        }
        return false;
    }

    /**
     * Returns the latest logs from the system
     *
     *
    */
    public function getLatest( $amount = 10 )
    {
        return $this->model
            ->orderBy('created_at', 'DESC')
            ->take( $amount )
            ->get();
    }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    public function store( $inputs )
    {
        $logs = $this->saveLogs( new $this->model, $inputs );

        if ( $logs ) {
            return $logs->toArray();
        } else {
            return false;
        }
    }
}
