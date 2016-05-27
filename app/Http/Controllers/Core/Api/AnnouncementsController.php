<?php namespace App\Http\Controllers\Core\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Transformers\Announcements as AnnouncementsTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Announcements;
use League\Fractal\Manager;
use App\Repositories\AnnouncementsRepository;
use App\Repositories\UserRepository;
use App\Events\Logs\LogsWasChanged;
use Event;

class AnnouncementsController extends ApiController
{
    /**
     * Announce repository
     *
     * @var Object
     */
    protected $announce = null;
    protected $user = null;

    /**
     * Constructor
     */
    public function __construct(Manager $fractal, AnnouncementsRepository $announce, UserRepository $user)
    {
        // Call parent implementation
        parent::__construct($fractal);

        // Inject the announce
        $this->announce = $announce;

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
        $isDashboard = $request->get('dashboard');

        if ( $isDashboard ) {
            return Datatables::of( $this->announce->getLatestAnnounce() )
            ->setTransformer( new AnnouncementsTransformer() )
            ->make(true);
        }
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
        $user = $this->user->findUserByToken( $request->get('api_token') );
        $announce = $this->announce->edit( $id );

        Event::fire( new LogsWasChanged(array(
            'comment'     => 'Видалив ',
            'title'       => $announce['title'],
            'type'        => 'destroy',
            'object_id'   => $id,
            'object_type' => 'App\Models\Announcements',
            'user_id'     => $user->id
        )));

        $result = [
            'deleted' => false
        ];

        if ($id > 0) {
            $result['deleted'] = $this->announce->destroy($id);
        }

        return $this->respond( $result );
    }

}
