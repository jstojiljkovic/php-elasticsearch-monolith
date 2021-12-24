<?php

namespace App\Providers;

use App\Interfaces\Services\RandomServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\RandomService;
use App\Services\UserService;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(RandomServiceInterface::class, RandomService::class);
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
