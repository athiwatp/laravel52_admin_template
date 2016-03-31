<?php namespace App\Repositories;

use App\Models\SocialAccount as SocialAccount;
use App\Models\User as User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Carbon\Carbon, Auth;

class SocialAccountRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\SocialAccount $account
     *
     * @return void
    */
    // public function __construct(SocialAccount $account)
    // {
    //     $this->model = $account;
    // }

    /**
     * Create or update Message
     *
     * @param App\Models\SocialAccount $account
     *
     * @return
    */
    // public function saveNews( $account, $inputs )
    // {
    //     //
    //     //
    //     return true;
    // }

    /**
     * Create a message
     *
     * @param array $inputs
     * @param int $user_id
     *
     * @return void
    */
    // public function store( $inputs )
    // {
    //     $id = $inputs['id'];

    //     if ( isset($id) && $id > 0 ) {
    //         $model = $this->model->find( $id );
    //     } else {
    //         $model = new $this->model;
    //     }

    //     if ( $id > 0 && $model->url != $inputs['url'] ) {
    //         $sSaveUrlHistory = cTrackChangesUrl::getItems(
    //             array(
    //                 'aData' => array(
    //                     'content_type' => UrlHistory::TYPE_NEWS,
    //                     'url' => $inputs['url'],
    //                     'type_id' => $inputs['id']
    //                 )
    //             ));
    //     }

    //     $account = $this->saveNews( $model, $inputs );
    // }

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

            if ( isset($user) && $user->is_verified === User::NOT_VERIFIED ) {
                $user->is_verified  = User::IS_VERIFIED;
                $user->save();

            } else {

                $user = new User;

                $user->email        = $providerUser->getEmail();
                $user->name         = $providerUser->getName();
                $user->api_token    = str_random(60);
                $user->password     = str_random(10);
                $user->is_verified  = User::IS_VERIFIED;

                $user->save();
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }

}
