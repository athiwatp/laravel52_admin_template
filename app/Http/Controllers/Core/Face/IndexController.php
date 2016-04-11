<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use App\Repositories\PagesRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\VideoNewsRepository;

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
     *
     */
    public function __construct(
        NewsRepository $news,
        PagesRepository $pages,
        GalleryRepository $gallery,
        VideoNewsRepository $video
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

        return $this->renderView('index.index', [
            'lNews' => $lNews,
            'lGallery' => $lGallery,
            'lVideo' => $lVideo,
            'currPage' => $currPage
        ]);
    }
}
