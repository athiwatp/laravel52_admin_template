<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * The entry point for the size
    */
    public function index()
    {
        return $this->renderView('home.index');
    }
}
