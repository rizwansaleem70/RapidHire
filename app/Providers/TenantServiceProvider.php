<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Contracts\CategoryContract;
use App\Http\Services\AuthService;
use App\Http\Services\Tenants\CategoryService;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthContract::class,
            function ($app) {
                return $app->make(AuthService::class);
            }
        );
        $this->app->bind(
            CategoryContract::class,
            function ($app) {
                return $app->make(CategoryService::class);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
