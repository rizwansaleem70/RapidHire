<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Contracts\Tenants\CategoryContract;
use App\Contracts\Tenants\DepartmentContract;
use App\Contracts\Tenants\JobContract;
use App\Contracts\Tenants\JobRequirementContract;
use App\Contracts\Tenants\LocationContract;
use App\Contracts\Tenants\MemberContract;
use App\Contracts\Tenants\QuestionBankContract;
use App\Contracts\Tenants\SettingContract;
use App\Contracts\Tenants\SocialMediaContract;
use App\Contracts\Tenants\TestContract;
use App\Contracts\Tenants\TestServiceContract;
use App\Http\Services\AuthService;
use App\Http\Services\Tenants\CategoryService;
use App\Http\Services\Tenants\DepartmentService;
use App\Http\Services\Tenants\JobRequirementService;
use App\Http\Services\Tenants\JobService;
use App\Http\Services\Tenants\LocationService;
use App\Http\Services\Tenants\MemberService;
use App\Http\Services\Tenants\QuestionBankService;
use App\Http\Services\Tenants\SettingService;
use App\Http\Services\Tenants\SocialMediaService;
use App\Http\Services\Tenants\TestService;
use App\Http\Services\Tenants\TestServiceService;
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
            JobRequirementContract::class,
            function ($app) {
                return $app->make(JobRequirementService::class);
            }
        );
        $this->app->bind(
            SocialMediaContract::class,
            function ($app) {
                return $app->make(SocialMediaService::class);
            }
        );
        $this->app->bind(
            SettingContract::class,
            function ($app) {
                return $app->make(SettingService::class);
            }
        );
        $this->app->bind(
            MemberContract::class,
            function ($app) {
                return $app->make(MemberService::class);
            }
        );
        $this->app->bind(
            QuestionBankContract::class,
            function ($app) {
                return $app->make(QuestionBankService::class);
            }
        );
        $this->app->bind(
            TestServiceContract::class,
            function ($app) {
                return $app->make(TestServiceService::class);
            }
        );
        $this->app->bind(
            TestContract::class,
            function ($app) {
                return $app->make(TestService::class);
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
