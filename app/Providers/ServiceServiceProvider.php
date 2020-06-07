<?php

namespace App\Providers;

use App\Services\AuthService as AuthServiceInterface;
use App\Services\Impl\AuthService;
use App\Services\Impl\UserService;
use App\Services\UserService as UserServiceInterface;
use App\Services\TaskService as TaskServiceInterface;
use App\Services\TaskTransactionService as TaskTransactionServiceInterface;
use App\Services\Impl\TaskTransactionService;
use App\Services\Impl\TaskService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);
        $this->app->singleton(TaskServiceInterface::class, TaskService::class);
        $this->app->singleton(TaskTransactionServiceInterface::class, TaskTransactionService::class);
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
