<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NewsRepository;
use Lang;

class PrintController extends FaceController
{
    /**
     * Repository instance
     *
     * @var App\Repositories\NewsRepository
     */
    protected $news = null;


    /**
     *  Constructor for the Class
     */
    public function __construct( NewsRepository $news )
    {
        // Call the parent controller first
        parent::__construct();

        // Inject the page instance
        $this->news = $news;
    }

    /**
     * Show news
    */
    public function showNews($url)
    {
        $lNews = $this->news->getByUrl( $url );

        if ( $lNews ) {
            return $this->renderView('news.print', [
                'news' => $lNews
            ]);
        }

        return redirect()->route('home')
            ->with('status', Lang::get('table_field.page_was_not_found'));
    }
}