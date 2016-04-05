<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository as News;

class IndexController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
    */
    protected $news = null;

    /**
     *
    */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Retrive the main page
     */
    public function index()
    {
        $latestsNews = $this->news->getLatest( 10 );

        return $this->renderView('index.index', [
            'lNews' => $latestsNews
        ]);
    }
}
