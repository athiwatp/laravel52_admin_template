<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\VideoNews as VideoNewsTransformer;
use League\Fractal\Manager;
use Yajra\Datatables\Facades\Datatables;
use App\Models\VideoNews;
use App\Repositories\VideoNewsRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class VideoNewsController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\VideoNewsRepository}
     */
    protected $video = null;
    protected $user = null;
    protected $fractal;

    /**
     * Constructor
    */
    public function __construct( Manager $fractal, VideoNewsRepository $video, UserRepository $user )
    {
        $this->fractal = $fractal;

        // inject video
        $this->video = $video;

        // User repository
        $this->user = $user;
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
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $videoNews = $this->video->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $videoNews['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\VideoNews',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->video->destroy($id);
        }

        return $this->respond( $result );
    }

}
