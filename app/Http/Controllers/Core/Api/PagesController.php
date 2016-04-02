<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use App\Http\Transformers\Pages as PagesTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Pages;

class PagesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Pages::query())
            ->setTransformer( new PagesTransformer() )
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
