<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;

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
    public function __construct(NewsRepository $news)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
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
