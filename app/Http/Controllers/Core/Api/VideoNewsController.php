<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use App\Http\Transformers\VideoNews as VideoNewsTransformer;
use League\Fractal\Manager;
use Yajra\Datatables\Facades\Datatables;
use App\Models\VideoNews;

class VideoNewsController extends ApiController
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
        return Datatables::of(VideoNews::query())
            ->setTransformer( new VideoNewsTransformer() )
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
