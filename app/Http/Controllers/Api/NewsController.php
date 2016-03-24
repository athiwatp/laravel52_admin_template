<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\News as NewsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\News;

class NewsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(News::query())
            ->setTransformer( new NewsTransformer() )
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
        $item = News::find($id);

        if ( ! $item)
        {
            return Response::json([
                'error' => [
                    'message' => 'Not Found',
                    'status_code' => 404
                ]
            ], 404);
        }

        return $this->fractal->item( $item, new NewsTransformer() );
    }

}
