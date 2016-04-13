<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\AnnouncementsRepository;

class AnnouncementsController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $announce = null;

    /**
     *
     */
    public function __construct(AnnouncementsRepository $announce)
    {
        $this->announce = $announce;
    }

    /**
     * Show announce details
     *
     * @param Request $request - the request object
     * @param Int $id - the announce identifier
     *
     * @return mixed
    */
    public function show(Request $request, $id)
    {
        $oAnnounce = $this->announce->getById( $id );

        if ( $oAnnounce ) {
            return $this->renderView('announces.show', [
                'announce' => $oAnnounce
            ]);
        }

        return redirect()->route('home')
            ->with('status', 'The page was not found');
    }

    /**
     * Output the list of announces sorted by the actual date
     *
     * @param Request $request - the request object
     *
     * @return mixed
    */
    public function index( Request $request )
    {
        $oAnnounces = $this->announce->getPaginatedList($request);

        if ( $oAnnounces ) {
            return $this->renderView('announces.index', [
                'announceList' => $oAnnounces
            ]);
        }

        return redirect()->route('home')
            ->with('status', 'The page was not found');
    }
}