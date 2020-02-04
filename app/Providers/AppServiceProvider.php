<?php

namespace App\Providers;

use App\Observers\ScheduleObserver;
use App\Observers\SubscriptionObserver;
use App\Schedule;
use App\Subscription;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \URL::forceScheme('https');

        Schedule::observe(ScheduleObserver::class);
        Subscription::observe(SubscriptionObserver::class);
    }
}
