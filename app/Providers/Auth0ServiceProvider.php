<?php

namespace App\Providers;

use Auth0\Login\Contract\Auth0UserRepository as Auth0UserRepositoryInterface;
use Auth0\Login\Repository\Auth0UserRepository;
use Illuminate\Support\ServiceProvider;

class Auth0ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Auth0UserRepositoryInterface::class,
            Auth0UserRepository::class
        );
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
