<?php

namespace App\Providers;

use App\Http\Services\ServiceService;
use App\Http\Services\ServiceServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            ServiceServiceInterface::class,
            ServiceService::class
        );
    }
}
