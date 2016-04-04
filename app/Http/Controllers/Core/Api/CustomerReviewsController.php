<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\CustomerReviews as CustomerReviewsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\CustomerReviews;

class CustomerReviewsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        return Datatables::of(CustomerReviews::query())
            ->setTransformer( new CustomerReviewsTransformer() )
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
