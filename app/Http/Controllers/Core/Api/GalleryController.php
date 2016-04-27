<?php namespace App\Http\Controllers\Core\Api;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Http\Transformers\Gallery as GalleryTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;

class GalleryController extends ApiController
{
    /**
     * Injected variable for the gallery
     *
     * @var {App\Repositories\GalleryRepository}
     */
    protected $gallery = null;

    protected $fractal;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, GalleryRepository $gallery)
    {
        $this->fractal = $fractal;

        // inject gallery
        $this->gallery = $gallery;
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
        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->gallery->destroy($id);
        }

        return $this->respond( $result );
    }

}
