<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Post;
use App\User;

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
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Passport::routes();

        // Gate::define('isAdmin', function (User $user) {
        //     return $user->role == 1;
        // });
        Gate::define('isMember', function ($user, $post) {
            return $user->id == $post->id_user;
        });

        Gate::define('IsAdmin', function ($user) {
            return $user->id_role == 1;
        });
    }
}
