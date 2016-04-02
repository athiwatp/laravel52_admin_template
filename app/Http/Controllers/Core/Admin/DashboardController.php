<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
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
