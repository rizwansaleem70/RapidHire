<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Contracts\Tenants\CategoryContract;
use App\Contracts\Tenants\DepartmentContract;
use App\Contracts\Tenants\JobContract;
use App\Contracts\Tenants\JobQualificationContract;
use App\Contracts\Tenants\LocationContract;
use App\Http\Services\AuthService;
use App\Http\Services\Tenants\CategoryService;
use App\Http\Services\Tenants\DepartmentService;
use App\Http\Services\Tenants\JobQualificationService;
use App\Http\Services\Tenants\JobService;
use App\Http\Services\Tenants\LocationService;
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
        $this->app->bind(
            LocationContract::class,
            function ($app) {
                return $app->make(LocationService::class);
            }
        );
        $this->app->bind(
            JobContract::class,
            function ($app) {
                return $app->make(JobService::class);
            }
        );
        $this->app->bind(
            DepartmentContract::class,
            function ($app) {
                return $app->make(DepartmentService::class);
            }
        );
        $this->app->bind(
            JobQualificationContract::class,
            function ($app) {
                return $app->make(JobQualificationService::class);
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
