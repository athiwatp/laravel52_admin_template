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
     * Retrive the news page
     */
    public function show(Request $request, $url)
    {
        $lNews = $this->news->getByUrl( $url );

        if ( $lNews ) {
            return $this->renderView('news.show', [
                'news' => $lNews
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
        $lNews = $this->news->getPaginatedList( $request );


        return $this->renderView('news.index', [
            'lNews' => $lNews
        ]);

    }
}
