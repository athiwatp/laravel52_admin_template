<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends AdminController
{
    /**
     * Login page
    */
    public function index()
    {
        return $this->renderView('user.login');
    }

    /**
     * Handle the authorization process
    */
    public function login()
    {

    }
}
