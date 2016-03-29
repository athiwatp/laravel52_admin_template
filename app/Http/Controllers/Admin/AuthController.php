<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth, Redirect, Lang;

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
     * Method to render the doLogin FORM
    */
    public function logout()
    {

        Auth::logout();

        return Redirect::route('home');
    }
}
