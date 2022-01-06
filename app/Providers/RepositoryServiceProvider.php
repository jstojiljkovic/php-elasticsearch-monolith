<?php

namespace App\Providers;

use App\Interfaces\Repositories\RandomRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\EloquentRandomRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(RandomRepositoryInterface::class, EloquentRandomRepository::class);

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
