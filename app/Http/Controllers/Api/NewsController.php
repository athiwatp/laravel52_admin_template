<?php namespace App\Http\Controllers\Api;


///https://laravelista.com/laravel-fractal/
///https://mattstauffer.co/blog/multiple-authentication-guard-drivers-including-api-in-laravel-5-2
///https://github.com/salebab/larasponse/tree/L5

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sorskod\Larasponse\Larasponse;

use App\Models\News;

class NewsController extends Controller
{
    protected $fractal;

    /**
     * Constructor
    */
    public function __construct(Larasponse $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->fractal->paginatedCollection( News::paginate() );
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
