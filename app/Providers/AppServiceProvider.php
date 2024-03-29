<?php

namespace App\Providers;

use App\Services\AccountTripService;
use App\Services\ModelService;
use App\Services\TripService;
use App\Services\UploadService;
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
        $this->app->bind(UploadService::class);
        $this->app->bind(TripService::class);
        $this->app->bind(AccountTripService::class);
        $this->app->bind(ModelService::class);
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
