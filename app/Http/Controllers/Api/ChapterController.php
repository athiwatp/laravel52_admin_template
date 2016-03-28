<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Chapters as ChaptersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Chapters;

class ChapterController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        return Datatables::of(Chapters::where('type_chapter', '=', $request->type))
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
