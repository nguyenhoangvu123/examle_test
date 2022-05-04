<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

         // auth Repo //
         $this->app->singleton(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
         // Category Repo //
         $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
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
