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

    public function login( Request $request )
    {
        $aAuthData = array(
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        );

        if ( Auth::attempt($aAuthData, $request->input('remember')) ) {
            return Redirect::route('admin.dashboard')
                ->with('message', Lang::get('layouts.layouts.you_are_logged') );
        } else {
            return Redirect::route('admin.login')
                ->with('message', Lang::get('layouts.login_form.email_or_password_is_incorrect') )
                ->withInput();
        }

    }

    /**
     * Method to render the doLogin FORM
    */
    public function logout()
    {

        Auth::logout();

        return Redirect::route('home')
            ->with('message', Lang::get('layouts.layouts.you_went_out_account') );
    }
}
