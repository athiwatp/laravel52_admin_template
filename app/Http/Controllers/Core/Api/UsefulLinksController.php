<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\UsefulLinks as UsefulLinksTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\UsefulLinks;
use League\Fractal\Manager;
use App\Repositories\UsefulLinksRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

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
    public function __construct( Manager $fractal, UsefulLinksRepository $usefulLinks, UserRepository $user )
    {
        // apply parent implementation
        parent::__construct($fractal);

        // useful links repository
        $this->usefulLinks = $usefulLinks;

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
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $link = $this->usefulLinks->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $link['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\UsefulLinks',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->usefulLinks->destroy($id);
        }

        return $this->respond( $result );
    }
}
