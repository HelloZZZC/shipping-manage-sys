<?php

namespace App\Providers;

use App\Component\BizAutoloader;
use Illuminate\Support\ServiceProvider;

class BizServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BizAutoloader::class, function($app){
            return new BizAutoloader($app);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
