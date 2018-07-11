<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HttpClientServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\HttpClient',
            'App\Services\HttpClient'
        );
    }

    public function provides()
    {
        return ['App\Contracts\HttpClient'];
    }
}
