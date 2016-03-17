<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Here should be defined the User Politics
        // 1. Create news
        $gate->define('read-news', function ( $user ) {
            return true;
        });

        $gate->define('write-news', function ($user) {
            return true;
        });


        // 2. Manage Settings
        $gate->define('read-settings', function ($user) {
            return true;
        });

        $gate->define('write-settings', function ($user) {
            return true;
        });

        // 3. Manage Users
        $gate->define('read-users', function ($user) {
            return true;
        });

        $gate->define('write-users', function ($user) {
            return true;
        });
    }
}
