<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\PagesRepository;


class PagesController extends FaceController
{
    /**
     * Repository instance
     *
     * @var App\Repositories\PagesRepository
     */
    protected $page = null;


    /**
     *  Constructor for the Class
     */
    public function __construct( PagesRepository $page )
    {
        // Inject the page instance
        $this->page = $page;
    }

    /**
     * Retrieve the main page
     *
     */
    public function show(Request $request, $url)
    {
        $oPage = $this->page->getByUrl( $url );

        if ( $oPage ) {
            return $this->renderView('pages.show', [
                'page' => $oPage
            ]);
        }

        return redirect()->route('home')
            ->with('status', 'Страница - не найдена!');
    }
}
