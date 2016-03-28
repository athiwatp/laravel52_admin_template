<?php namespace App\Http\Controllers\Api;

///https://laravelista.com/laravel-fractal/
///https://mattstauffer.co/blog/multiple-authentication-guard-drivers-including-api-in-laravel-5-2
///https://github.com/salebab/larasponse/tree/L5

use Illuminate\Http\Response as IlluminateResponse;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;

class ApiController extends Controller
{
    protected $statusCode = IlluminateResponse::HTTP_OK;

    protected $fractal;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal)
    {
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