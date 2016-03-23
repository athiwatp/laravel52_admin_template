<?php namespace App\Http\Controllers\Api;


///https://laravelista.com/laravel-fractal/
///https://mattstauffer.co/blog/multiple-authentication-guard-drivers-including-api-in-laravel-5-2
///https://github.com/salebab/larasponse/tree/L5

use Illuminate\Http\Request;

use App\Http\Requests;
use Sorskod\Larasponse\Larasponse;
use App\Http\Transformers\User as UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use Yajra\Datatables\Facades\Datatables;

use App\Models\User;

class UsersController extends ApiController
{
    protected $fractal;

    /**
     * Constructor
    */
    public function __construct(Manager $fractal)
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
        return Datatables::of(User::query())
            ->setTransformer( new UserTransformer() )
            ->make(true);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = user::find($id);

        if ( ! $item)
        {
            return Response::json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code' => 404
                ]
            ], 404);
        }

        return $this->fractal->item( $item, new UserTransformer() );
    }

}
