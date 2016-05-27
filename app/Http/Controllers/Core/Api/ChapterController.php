<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Chapters as ChaptersTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Chapters;
use League\Fractal\Manager;
use App\Repositories\ChaptersRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class ChapterController extends ApiController
{
    /**
     * Injected variable for the chapters
     *
     * @var {App\Repositories\ChaptersRepository}
     */
    protected $_chapter = null;
    protected $user = null;

    /**
     * Constructor
     */
    public function __construct( Manager $fractal, ChaptersRepository $chapter, UserRepository $user )
    {
        // apply parent implementation
        parent::__construct($fractal);

        // Chapter repository
        $this->_chapter = $chapter;

        // User repository
        $this->user = $user;
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
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $chapter = $this->_chapter->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $chapter['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\Chapters',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->_chapter->destroy($id);
        }

        return $this->respond( $result );
    }
}
