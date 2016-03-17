<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends AdminController
{
    /**
     * Retrive the main page
    */
    public function index()
    {
        return $this->renderView('user.dashboard');
    }
}
