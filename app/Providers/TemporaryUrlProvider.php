<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class TemporaryUrlProvider extends ServiceProvider
{
    public function register()
    {
        // Register the getTempUrl method
        $this->app->bind('getTempUrl', function () {
            return function ($path) {
                return Storage::temporaryUrl($path, now()->addMinutes(5));
            };
        });
    }
    public function boot()
    {
        // Register the getTempUrl method
        app()->bind('getTempUrl', function () {
            return function ($path) {
                return Storage::temporaryUrl($path, now()->addMinutes(5));
            };
        });
    }
}