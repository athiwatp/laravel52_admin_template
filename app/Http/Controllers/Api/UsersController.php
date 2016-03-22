<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Users as UsersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\User;

class UsersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(User::query())
            ->setTransformer( new UsersTransformer() )
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
