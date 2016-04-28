<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\News as NewsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\News;
use League\Fractal\Manager;
use App\Repositories\NewsRepository;

class NewsController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\ChaptersRepository}
     */
    protected $news = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, NewsRepository $news)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // page repository
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
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

    /**
     * Destroy the announce item
     *
     * @param id {Integer} - menu identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->news->destroy($id);
        }

        return $this->respond( $result );
    }

}
