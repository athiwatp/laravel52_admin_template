<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Chapters as ChaptersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Chapters;

class NewsChapterController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Chapters::query())
            ->setTransformer( new ChaptersTransformer() )
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
