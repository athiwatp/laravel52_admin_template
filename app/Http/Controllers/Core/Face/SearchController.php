<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\SearchRepository;

class SearchController extends FaceController
{
    /**
     * Injected news repository object
     *
     * @var Object
     */
    protected $search = null;

    /**
     *
     */
    public function __construct(SearchRepository $search)
    {
        // Call the parent controller first
        parent::__construct();

        // Implement here custom logic
        $this->search = $search;
    }

    /**
     * Retrive the news page
     */
    public function show(Request $request, $id)
    {
        dd('Search result');
    }

    /**
     * Output the list of news
     *
     */
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');

        $result = $this->search->get($keywords);

        return $this->renderView('search.index', [
            'result' => $result
        ]);
        dd($keywords);
    }
}
