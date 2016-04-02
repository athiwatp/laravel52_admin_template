<?php

namespace App\Http\Controllers\Core\Face;

use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends FaceController
{
    /**
     * Retrive the main page
     */
    public function index()
    {
        return $this->renderView('index.index');
    }
}
