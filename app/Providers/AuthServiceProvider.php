<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Adminn role

        //users
        Gate::define('create-user', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('edit-user', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('delete-user', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('show-user', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('all-user', function ($user) {
            return $user->isAdmin();
        });

        //price
        Gate::define('all-price', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('create-price', function ($user) {
            return $user->isAdmin();
        });
        Gate::define('edit-price', function ($user) {
            return $user->isAdmin();
        });


        //Superviser Role

        //Partenaire
        Gate::define('create-partener', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('edit-partener', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('delete-partener', function ($user) {
            return $user->isSuperviser();
        });

        //delever
        Gate::define('create-deliver', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('show-deliver', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('delete-deliver', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('block-deliver', function ($user) {
            return $user->isSuperviser();
        });

        //type
        Gate::define('edit-type', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('delete-type', function ($user) {
            return $user->isSuperviser();
        });

        //promo
        Gate::define('create-promo', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('active-promo', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('makeIt-promo', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('edit-promo', function ($user) {
            return $user->isSuperviser();
        });
        Gate::define('delete-promo', function ($user) {
            return $user->isSuperviser();
        });
        //meal
        Gate::define('delete-meal', function ($user) {
            return $user->isSuperviser();
        });
        //group
        Gate::define('delete-group', function ($user) {
            return $user->isSuperviser();
        });

        //gestionnaire

        //Meals
        Gate::define('create-meal', function ($user) {
            return $user->isGestionnaire();
        });
        Gate::define('edit-meal', function ($user) {
            return $user->isGestionnaire();
        });
        Gate::define('all-meal', function ($user) {
            return $user->isGestionnaire();
        });

        //group
        Gate::define('all-group', function ($user) {
            return $user->isGestionnaire();
        });
        Gate::define('create-group', function ($user) {
            return $user->isGestionnaire();
        });
        Gate::define('edit-group', function ($user) {
            return $user->isGestionnaire();
        });
        
        //order
        Gate::define('all-order', function ($user) {
            return $user->isGestionnaire();
        });
        Gate::define('show-order', function ($user) {
            return $user->isGestionnaire();
        });
    }
}
