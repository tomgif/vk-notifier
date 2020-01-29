<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return $user->hasRole('manage-users');
        });

        Gate::define('manage-subscriptions', function ($user) {
            return $user->hasRole('manage-subscriptions');
        });

        Gate::define('manage-mailing', function ($user) {
            return $user->hasRole('manage-mailing');
        });

        Gate::define('manage-schedules', function ($user) {
            return $user->hasRole('manage-schedules');
        });
    }
}
