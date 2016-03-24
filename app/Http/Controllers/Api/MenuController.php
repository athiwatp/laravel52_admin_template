<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Menues as MenuTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Menues;

class MenuController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Menues::query())
            ->setTransformer( new MenuTransformer() )
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
