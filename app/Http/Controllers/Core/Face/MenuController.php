<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\MenuesRepository;
use App\Repositories\PagesRepository;
use Config;

class MenuController extends FaceController
{

    /**
     * Repository instance
     *
     * @var App\Repositories\MenuesRepository
    */
    protected $menu = null;

    /**
     * Repository instance
     *
     * @var App\Repositories\PagesRepository
     */
    protected $page = null;


    /**
     *  Constructor for the Class
    */
    public function __construct( MenuesRepository $menu, PagesRepository $page )
    {
        // Call the parent controller first
        parent::__construct();

        // Inject the menu instance
        $this->menu = $menu;

        // Inject the page instance
        $this->page = $page;
    }

    /**
     * Retrieve the menue
     *
     */
    public function show(Request $request, $url)
    {
        $oMenu = $this->menu->getByUrl( $url );

        if ( $oMenu ) {
            if ( $oMenu->is_redirectable == 1 && $oMenu->redirect_url  ) {
                return redirect()->away( $oMenu->redirect_url );
            }

            if ( $oMenu->page_id > 0 ) {
                $oPage = $this->page->getById( $oMenu->page_id );

                if ( $oPage ) {
                    return redirect()->action('Core\Face\PagesController@show', [
                        'url' => $oPage->url
                    ]);
                }
            }
        }

        return redirect()->route('home')
            ->with('status', 'Страница - не найдена!');
    }
}
