<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\UsefulLinks as UsefulLinksTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\UsefulLinks;
use League\Fractal\Manager;
use App\Repositories\UsefulLinksRepository;

class UsefulLinksController extends ApiController
{
    /**
     * Injected variable for the useful links
     *
     * @var {App\Repositories\UsefulLinksRepository}
     */
    protected $usefulLinks = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, UsefulLinksRepository $usefulLinks)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // useful links repository
        $this->usefulLinks = $usefulLinks;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(UsefulLinks::query())
            ->setTransformer( new UsefulLinksTransformer() )
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
     * Destroy the useful links item
     *
     * @param id {Integer} - useful links identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->usefulLinks->destroy($id);
        }

        return $this->respond( $result );
    }
}
