<?php

namespace RichToms\LaravelJsend;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use JSendFacade as JSend;

class LaravelJsendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('jsend', function ($data = [], $statusCode = 200, $headers = []) {
            return JSend::build($data, $statusCode, $headers);
        });
    }

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
