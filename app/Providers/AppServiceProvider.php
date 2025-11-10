<?php

namespace App\Providers;

use App\Domain\Task\Repository\TaskRepositoryInterface;
use App\Domain\Task\Service\TaskService;
use App\Domain\Task\Service\TaskServiceInterface;
use App\Factories\Response\ApiResponseFactory;
use App\Factories\Response\DefaultApiResponseFactory;
use App\Repositories\Eloquent\TaskRepository;
use App\Services\Notification\EloquentUserNotificationService;
use App\Services\Notification\NotificationServiceInterface;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelData\Data;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton(ApiResponseFactory::class, DefaultApiResponseFactory::class);

        // Repositories
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

        // Services
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(NotificationServiceInterface::class, EloquentUserNotificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
