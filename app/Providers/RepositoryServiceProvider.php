<?php

namespace App\Providers;

use App\Interfaces\Repositories\RandomRepositoryInterface;
use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\ElasticSearchSearchRepository;
use App\Repositories\EloquentRandomRepository;
use App\Repositories\EloquentSearchRepository;
use App\Repositories\EloquentUserRepository;
use App\Services\ElasticSearchSearchService;
use App\Services\EloquentSearchService;
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
