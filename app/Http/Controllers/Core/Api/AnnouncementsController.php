<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use App\Http\Transformers\Announcements as AnnouncementsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Announcements;

class AnnouncementsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Announcements::query())
            ->setTransformer( new AnnouncementsTransformer() )
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
