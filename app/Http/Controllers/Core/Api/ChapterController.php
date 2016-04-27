<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Chapters as ChaptersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Chapters;
use League\Fractal\Manager;
use App\Repositories\ChaptersRepository;

class ChapterController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\ChaptersRepository}
     */
    protected $_chapter = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, ChaptersRepository $chapter)
    {
        // apply parent implementation
        parent::__construct($fractal);

        // Chapter repository
        $this->_chapter = $chapter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        return Datatables::of(Chapters::where('type_chapter', '=', $request->type))
            ->setTransformer( new ChaptersTransformer() )
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
            $result['deleted'] = $this->_chapter->destroy($id);
        }

        return $this->respond( $result );
    }
}
