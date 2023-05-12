<?php

namespace App\Providers\Auth;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\AuthServices\Impl\AuthServiceImpl;


class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('authservice', function () {
            new AuthServiceImpl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
