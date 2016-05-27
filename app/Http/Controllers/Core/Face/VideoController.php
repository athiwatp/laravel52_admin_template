<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\VideoNewsRepository;
use Lang;

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
                'lVideo' => $lVideo,
                'aTitle' => $lVideo->title
            ]);
        }

        return redirect()->route('home')
            ->with('status', Lang::get('table_field.page_was_not_found'));
    }

    /**
     * Output the list of news
     *
     */
    public function index(Request $request)
    {
        $lVideo = $this->video->getPaginatedList( $request );


        return $this->renderView('video.index', [
            'lVideo' => $lVideo,
            'aTitle' => Lang::get('videoNews.lists.video_news')
        ]);

    }
}
