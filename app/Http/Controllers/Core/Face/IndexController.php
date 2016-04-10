<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use App\Repositories\PagesRepository;

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
     *
     */
    public function __construct(NewsRepository $news, PagesRepository $pages)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->news = $news;

        // Inject pages
        $this->pages = $pages;
    }

    /**
     * Retrive the main page
     */
    public function index()
    {
        // Get the latest news
        $lNews = $this->news->getLatest( 10 );

        // Get the page to load by default
        $currPage = $this->pages->getDefaultPage();

        return $this->renderView('index.index', [
            'lNews' => $lNews,
            'currPage' => $currPage
        ]);
    }
}
