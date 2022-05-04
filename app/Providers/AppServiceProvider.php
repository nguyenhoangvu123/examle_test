<?php

namespace App\Providers;

use App\Helpers\FileUploadHepler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // facades file //
        $this->app->singleton('file' ,function() {
            return new FileUploadHepler();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
