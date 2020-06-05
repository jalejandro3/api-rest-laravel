<?php

namespace App\Providers;

use App\Services\AuthService as AuthServiceInterface;
use App\Services\Impl\AuthService;
use App\Services\Impl\SecurityService;
use App\Services\Impl\UserService;
use App\Services\SecurityService as SecurityServiceInterface;
use App\Services\UserService as UserServiceInterface;
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
        $this->app->singleton(SecurityServiceInterface::class, SecurityService::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);
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
