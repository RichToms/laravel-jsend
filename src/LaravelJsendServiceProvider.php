<?php

namespace RichToms\LaravelJsend;

use JSendFacade as JSend;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

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
            return response()->json(
                JSend::build($data, $statusCode), 
                $statusCode, 
                $headers
            );
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
