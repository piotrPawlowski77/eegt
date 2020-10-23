<?php

namespace App\Providers;

use App\eegt\Interfaces\BackendRepositoryInterface;
use App\eegt\Interfaces\FrontendRepositoryInterface;
use App\eegt\Repositories\BackendRepository;
use App\eegt\Repositories\FrontendRepository;
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
        $this->app->bind(FrontendRepositoryInterface::class, function (){
            return new FrontendRepository();
        });

        $this->app->bind(BackendRepositoryInterface::class, function (){
            return new BackendRepository();
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
