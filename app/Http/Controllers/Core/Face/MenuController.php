<?php namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\PagesRepository as Page;

class MenuController extends FaceController
{
    /**
     * Retrieve the menue
     *
     */
    public function show(Request $request, $url)
    {
        $menu = Page::get( $url );

        dd( $menu );

//        return $this->renderView('pages.index', [
//            'page' => $page
//        ]);
    }
}
