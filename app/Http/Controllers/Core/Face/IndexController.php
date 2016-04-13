<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use App\Repositories\PagesRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\VideoNewsRepository;
use App\Repositories\AnnouncementsRepository;

class IndexController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $news = null;

    /**
     * Inject Page repository to manage the pages
     *
     * @var Object
    */
    protected $pages = null;

    /**
     * Inject Galery repository to manage the photos
     *
     * @var Object
     */
    protected $gallery = null;

    /**
     * Inject Video news repository to manage the videos
     *
     * @var Object
     */
    protected $video = null;

    /**
     * Inject announce repository to manage the announces
     *
     * @var Object
     */
    protected $announce = null;

    /**
     *
     */
    public function __construct(
        NewsRepository $news,
        PagesRepository $pages,
        GalleryRepository $gallery,
        VideoNewsRepository $video,
        AnnouncementsRepository $announce
    )
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->news = $news;

        // Inject pages
        $this->pages = $pages;

        // Inject gallery
        $this->gallery = $gallery;

        // Inject gallery
        $this->video = $video;

        // Inject announce
        $this->announce = $announce;
    }

    /**
     * Retrive the main page
     */
    public function index()
    {
        // Get the latest news
        $lNews = $this->news->getLatest( 10 );

        // Get latest photo
        $lGallery = $this->gallery->getLatest( 20 );

        // Get latest video
        $lVideo = $this->video->getLatest( 10 );

        // Get the page to load by default
        $currPage = $this->pages->getDefaultPage();

        //Get announces
        $lImportantAnnounces = $this->announce->getLatest(10, true);
        $lRegularAnnounces   = $this->announce->getLatest(10);
        $lTopicalAnnounces   = $this->announce->getLatest(10, null, true);

        return $this->renderView('index.index', [
            'lNews' => $lNews,
            'lGallery' => $lGallery,
            'lVideo' => $lVideo,
            'lImportantAnnounces' => $lImportantAnnounces,
            'lRegularAnnounces' => $lRegularAnnounces,
            'lTopicalAnnounces' => $lTopicalAnnounces,
            'currPage' => $currPage,

        ]);
    }
}
