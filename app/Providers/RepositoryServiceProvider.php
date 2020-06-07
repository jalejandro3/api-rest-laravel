<?php

namespace App\Providers;

use App\Repositories\TaskTransactionRepository as TaskTransactionRepositoryInterface;
use App\Repositories\Impl\TaskTransactionRepository;
use App\Repositories\UserRepository as UserRepositoryInterface;
use App\Repositories\Impl\UserRepository;
use App\Repositories\TaskRepository as TaskRepositoryInterface;
use App\Repositories\Impl\TaskRepository;
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
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->singleton(TaskTransactionRepositoryInterface::class, TaskTransactionRepository::class);
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
