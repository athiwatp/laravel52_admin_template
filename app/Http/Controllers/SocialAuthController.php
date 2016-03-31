<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\SocialAccountRepository;
use Socialite, Redirect, Lang;

class SocialAuthController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * when facebook call us a with token
     *
     */
    public function facebookCallback( SocialAccountRepository $service )
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return Redirect::route('home')
            ->with('message', array(
                'code'      => self::$statusOk,
                'message'   => Lang::get('users.lists.users_logined_facebook') ));
    }

}
