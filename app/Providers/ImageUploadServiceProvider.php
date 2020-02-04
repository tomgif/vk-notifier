<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageUploadServiceProvider extends ServiceProvider
{
    /**
     * Register ImageService class with the Laravel IoC container.
     * @return void
     */
    public function register()
    {
        $this->app->bind('ImageUploadService', function () {
            return new \App\Services\ImageUploadService;
        });
    }
}
