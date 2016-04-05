<?php namespace App\Repositories;

use App\Models\SocialAccount as SocialAccount;
use App\Models\User as User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Carbon\Carbon, Auth, Config;

class SocialAccountRepository extends BaseRepository {

    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount;

            $account->provider_user_id  = $providerUser->getId();
            $account->provider          = 'facebook';

            $user = User::whereEmail($providerUser->getEmail())->first();

            if ( isset($user) && $user->is_verified === Config::get('constants.USERS.NOT_VERIFIED') ) {
                $user->is_verified  = Config::get('constants.USERS.IS_VERIFIED');
                $user->save();

            } else {
                $user = new User;

                $user->email        = $providerUser->getEmail();
                $user->name         = $providerUser->getName();
                $user->api_token    = str_random(60);
                $user->password     = str_random(10);
                $user->is_verified  = Config::get('constants.USERS.IS_VERIFIED');

                $user->save();
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
