<?php namespace App\Http\Controllers\Core\Api;

use Illuminate\Http\Request;
use Sorskod\Larasponse\Larasponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Http\Transformers\Gallery as GalleryTransformer;
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
        //
    }
}
