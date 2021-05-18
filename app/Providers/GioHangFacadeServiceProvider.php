<?php

namespace App\Providers;

use App\Helpers\GioHangService; 
use Illuminate\Support\ServiceProvider;

class GioHangFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('giohang', function($app) {
            return new GioHangService();
        }); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
