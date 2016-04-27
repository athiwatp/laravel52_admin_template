<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\VideoNews as VideoNewsTransformer;
use League\Fractal\Manager;
use Yajra\Datatables\Facades\Datatables;
use App\Models\VideoNews;
use App\Repositories\VideoNewsRepository;

class VideoNewsController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\VideoNewsRepository}
     */
    protected $video = null;


    protected $fractal;

    /**
     * Constructor
    */
    public function __construct(Manager $fractal, VideoNewsRepository $video)
    {
        $this->fractal = $fractal;

        // inject video
        $this->video = $video;
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
            $result['deleted'] = $this->video->destroy($id);
        }

        return $this->respond( $result );
    }

}
