<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use App\Repositories\ChaptersRepository;
use Lang;

class NewsController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $news = null;

    /**
     * Inject the chapter repository
     *
     * @var {Object}
     */
    protected $news_chapter = null;

    /**
     *
     */
    public function __construct( NewsRepository $news, ChaptersRepository $chapter )
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->news = $news;

        // inject the chapter repository
        $this->news_chapter = $chapter;
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
            ->with('status', Lang::get('table_field.page_was_not_found'));
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
