<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Sorskod\Larasponse\Larasponse;
use App\Http\Transformers\Gallery as GalleryTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use Yajra\Datatables\Facades\Datatables;

use App\Models\Gallery;

class GalleryController extends ApiController
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
        return Datatables::of(Gallery::query())
            ->setTransformer( new GalleryTransformer() )
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
        $item = Gallery::find($id);

        if ( ! $item)
        {
            return Response::json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code' => 404
                ]
            ], 404);
        }

        return $this->fractal->item( $item, new GalleryTransformer() );
    }

}
