<?php

namespace App\Providers;

use App\Contracts\AuthTenantContract;
use App\Http\Services\AuthTenantService;
use Illuminate\Support\ServiceProvider;

class SuperAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthTenantContract::class,
            function ($app) {
                return $app->make(AuthTenantService::class);
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
