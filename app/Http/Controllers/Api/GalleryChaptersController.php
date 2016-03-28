<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Chapters as ChaptersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Chapters;

class GalleryChaptersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $sType )
    {
        return Datatables::of(Chapters::query())
            ->where('type_chapter', '=', 1)
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
