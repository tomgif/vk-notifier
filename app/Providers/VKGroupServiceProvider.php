<?php

namespace App\Providers;

use App\Services\VKGroupService;
use Illuminate\Support\ServiceProvider;

class VKGroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->app->bind('VKGroupService', function () {
            return new VKGroupService;
        });
    }
}
