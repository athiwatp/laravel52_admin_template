<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Announcements as AnnouncementsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Announcements;
use League\Fractal\Manager;
use App\Repositories\AnnouncementsRepository;

class AnnouncementsController extends ApiController
{
    /**
     * Announce repository
     *
     * @var Object
     */
    protected $announce = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, AnnouncementsRepository $announce)
    {
        // Call parent implementation
        parent::__construct($fractal);

        // Inject the announce
        $this->announce = $announce;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
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
            $result['deleted'] = $this->announce->destroy($id);
        }

        return $this->respond( $result );
    }

}
