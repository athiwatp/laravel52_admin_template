<?php namespace App\Http\Controllers\Core\Api;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Http\Transformers\Gallery as GalleryTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class GalleryController extends ApiController
{
    /**
     * Injected variable for the gallery
     *
     * @var {App\Repositories\GalleryRepository}
     */
    protected $gallery = null;
    protected $user = null;

    protected $fractal;

    /**
     * Constructor
     */
    public function __construct( Manager $fractal, GalleryRepository $gallery, UserRepository $user )
    {
        $this->fractal = $fractal;

        // inject gallery
        $this->gallery = $gallery;

        // User repository
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Datatables::of(Gallery::query())
            ->setTransformer( new GalleryTransformer() )
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
        $gallery = $this->gallery->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $gallery['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\Gallery',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->gallery->destroy($id);
        }

        return $this->respond( $result );
    }

}
