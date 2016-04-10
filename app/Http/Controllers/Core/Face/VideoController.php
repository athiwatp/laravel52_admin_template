<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\VideoNewsRepository;

class VideoController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $video = null;

    /**
     *
     */
    public function __construct(VideoNewsRepository $video)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->video = $video;
    }

    /**
     * Retrive the news page
     */
    public function show(Request $request, $id)
    {
        $lVideo = $this->video->getById( $id );

        if ( $lVideo ) {
            return $this->renderView('video.show', [
                'lVideo' => $lVideo
            ]);
        }

        return redirect()->route('home')
            ->with('status', 'Страница - не найдена!');
    }

    /**
     * Output the list of news
     *
     */
    public function index(Request $request)
    {
        $lVideo = $this->video->getPaginatedList( $request );


        return $this->renderView('video.index', [
            'lVideo' => $lVideo
        ]);

    }
}
