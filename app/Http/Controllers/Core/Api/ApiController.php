<?php namespace App\Http\Controllers\Core\Api;

use Illuminate\Http\Response as IlluminateResponse;
use App\Http\Controllers\Core\Controller;
use League\Fractal\Manager;

class ApiController extends Controller
{
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Injected variable for the fractal
     *
     * @var {League\Fractal\Manager}
     */
    protected $fractal;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal)
    {
        // apply parent implementation
        parent::__construct();

        // Inject fractal
        $this->fractal = $fractal;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

}