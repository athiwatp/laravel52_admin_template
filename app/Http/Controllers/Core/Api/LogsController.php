<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Logs as LogsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Logs;
use League\Fractal\Manager;
use App\Repositories\LogsRepository;

class LogsController extends ApiController
{
    /**
     * Injected variable for the logs
     *
     * @var {App\Repositories\LogsRepository}
     */
    protected $logs = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, LogsRepository $logs)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // Logs repository
        $this->logs = $logs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $isDashboard = $request->get('dashboard');

        if ( $isDashboard ) {
            return Datatables::of( $this->logs->getLatest() )
                ->setTransformer( new LogsTransformer() )
                ->make(true);
        }

        return Datatables::of( Logs::query() )
            ->orderBy('created_at', 'desc')
            ->setTransformer( new LogsTransformer() )
            ->make(true);
    }
}
