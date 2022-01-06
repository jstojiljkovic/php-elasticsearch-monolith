<?php

namespace App\Providers;

use App\Http\Controllers\Api\V1\RandomESController;
use App\Http\Controllers\Api\V1\RandomSQLController;
use App\Interfaces\Services\ElasticSearchWrapperInterface;
use App\Interfaces\Services\RandomServiceInterface;
use App\Interfaces\Services\SearchServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\ElasticSearchSearchRepository;
use App\Repositories\EloquentSearchRepository;
use App\Services\ElasticSearchWrapperService;
use App\Services\RandomService;
use App\Services\SearchService;
use App\Services\UserService;
use Cviebrock\LaravelElasticsearch\Factory;
use Cviebrock\LaravelElasticsearch\Manager;
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
        $this->app->bind(SearchServiceInterface::class, SearchService::class);
        $this->app->when(RandomSQLController::class)
            ->needs(SearchServiceInterface::class)
            ->give(function () {
                return new SearchService(new EloquentSearchRepository());
            });
        $this->app->bind(ElasticSearchWrapperInterface::class, ElasticSearchSearchRepository::class);
        $this->app->when(RandomESController::class)
            ->needs(SearchServiceInterface::class)
            ->give(function () {
                return new SearchService(
                    new ElasticSearchSearchRepository(
                        new ElasticSearchWrapperService(
                            new Manager(
                                $this->app,
                                new Factory()
                            )
                        )
                    )
                );
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
