<?php

namespace App\Http\Controllers\Core\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;

use App\Http\Requests;
use App\Http\Controllers\Core\Controller;
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
