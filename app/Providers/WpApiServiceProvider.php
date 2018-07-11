<?php

namespace App\Providers;

use App\Contracts\HttpClient;
use App\Services\WpApi;
use Illuminate\Support\ServiceProvider;

class WpApiServiceProvider extends ServiceProvider
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
        $this->app->singleton(WpApi::class, function ($app) {
            return new WpApi(env('WP_API_URL'), $app[HttpClient::class]);
        });
    }

    public function provides()
    {
        return [WpApi::class];
    }
}
