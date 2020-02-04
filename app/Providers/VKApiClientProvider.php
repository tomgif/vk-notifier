<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VKApiClientProvider extends ServiceProvider
{
    /**
     * Register ImageService class with the Laravel IoC container.
     * @return void
     */
    public function register()
    {
        $this->app->bind('VK\Client\VKApiClient', function () {
            return new \VK\Client\VKApiClient;
        });
    }
}
