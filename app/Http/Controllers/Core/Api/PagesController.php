<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Pages as PagesTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Pages;
use League\Fractal\Manager;
use App\Repositories\PagesRepository;

class PagesController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\ChaptersRepository}
     */
    protected $page = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, PagesRepository $page)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // page repository
        $this->page = $page;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Pages::query())
            ->setTransformer( new PagesTransformer() )
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
            $result['deleted'] = $this->page->destroy($id);
        }

        return $this->respond( $result );
    }
}
