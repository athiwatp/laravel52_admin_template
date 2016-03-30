<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Gallery as GalleryTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Gallery;

class GalleryController extends ApiController
{
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
