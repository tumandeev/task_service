<?php

namespace App\Providers;

use App\Factories\Response\ApiResponseFactory;
use App\Factories\Response\DefaultApiResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton(ApiResponseFactory::class, DefaultApiResponseFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
