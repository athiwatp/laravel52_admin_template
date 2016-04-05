<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository as News;

class NewsController extends FaceController
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
    public function show(Request $request, $url)
    {
        return $this->renderView('news.show', [
            'news' => $this->news->getByUrl( $url )
        ]);
    }
}
