<?php

namespace RichToms\LaravelJsend;

use Illuminate\Support\ServiceProvider;

class LaravelJsendServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('laravel-jsend', function () {
            return new JSend;
        });
    }
}
