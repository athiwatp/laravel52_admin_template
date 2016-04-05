<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\PagesRepository as Page;

class PagesController extends FaceController
{
    /**
     * Retrieve the main page
     *
     */
    public function show(Request $request, $url)
    {
//        $request->get();

        $page = Page::get( $url );

        dd( $page );

        return $this->renderView('pages.index', [
            'page' => $page
        ]);
    }
}
