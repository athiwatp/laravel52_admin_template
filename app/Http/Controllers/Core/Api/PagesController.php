<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Pages as PagesTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Pages;
use League\Fractal\Manager;
use App\Repositories\PagesRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class PagesController extends ApiController
{
    /**
     * Injected variable for the pages
     *
     * @var {App\Repositories\PagesRepository}
     */
    protected $page = null;
    protected $user = null;

    /**
     * Constructor
     */
    public function __construct( Manager $fractal, PagesRepository $page, UserRepository $user )
    {
        // apply parent implementation
        parent::__construct($fractal);

        // Page repository
        $this->page = $page;

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
     * @param id {Integer} - page identifier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $page = $this->page->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $page['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\Pages',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->page->destroy($id);
        }

        return $this->respond( $result );
    }
}
