<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Http\Services\AuthService;
use App\Contracts\Tenants\JobContract;
use App\Contracts\Tenants\TestContract;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenants\MemberContract;
use App\Http\Services\Tenants\JobService;
use App\Contracts\Tenants\SettingContract;
use App\Http\Services\Tenants\TestService;
use App\Contracts\Tenants\CategoryContract;
use App\Contracts\Tenants\LocationContract;
use App\Contracts\Tenants\InterviewContract;
use App\Http\Services\Tenants\MemberService;
use App\Contracts\Tenants\DepartmentContract;
use App\Http\Services\Tenants\SettingService;
use App\Contracts\Tenants\ImageUploadContract;
use App\Contracts\Tenants\RequirementContract;
use App\Contracts\Tenants\SocialMediaContract;
use App\Contracts\Tenants\TestServiceContract;
use App\Http\Services\Tenants\CategoryService;
use App\Http\Services\Tenants\LocationService;
use App\Contracts\Tenants\QuestionBankContract;
use App\Http\Services\Tenants\InterviewService;
use App\Http\Services\Tenants\DepartmentService;
use App\Contracts\Tenants\Users\UserAuthContract;
use App\Http\Services\Tenants\ImageUploadService;
use App\Http\Services\Tenants\RequirementService;
use App\Http\Services\Tenants\SocialMediaService;
use App\Http\Services\Tenants\TestServiceService;
use App\Contracts\Tenants\Candidates\HomeContract;
use App\Contracts\Tenants\JobShortlistingContract;
use App\Http\Services\Tenants\QuestionBankService;
use App\Contracts\Tenants\InterviewFeedbackContract;
use App\Http\Services\Tenants\Users\UserAuthService;
use App\Http\Services\Tenants\Candidates\HomeService;
use App\Http\Services\Tenants\JobShortlistingService;
use App\Http\Services\Tenants\InterviewFeedbackService;
use App\Contracts\Tenants\Candidates\JobContract as CandidateJobContract;
use App\Http\Services\Tenants\Candidates\JobService as CandidateJobService;

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
            RequirementContract::class,
            function ($app) {
                return $app->make(RequirementService::class);
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
        $this->app->bind(
            JobShortlistingContract::class,
            function ($app) {
                return $app->make(JobShortlistingService::class);
            }
        );
        $this->app->bind(
            UserAuthContract::class,
            function ($app) {
                return $app->make(UserAuthService::class);
            }
        );
        $this->app->bind(
            InterviewFeedbackContract::class,
            function ($app) {
                return $app->make(InterviewFeedbackService::class);
            }
        );
        $this->app->bind(
            ImageUploadContract::class,
            function ($app) {
                return $app->make(ImageUploadService::class);
            }
        );
        $this->app->bind(
            HomeContract::class,
            function ($app) {
                return $app->make(HomeService::class);
            }
        );
        $this->app->bind(
            CandidateJobContract::class,
            function ($app) {
                return $app->make(CandidateJobService::class);
            }
        );
        $this->app->bind(
            \App\Contracts\Tenants\HomeContract::class,
            function ($app) {
                return $app->make(\App\Http\Services\Tenants\HomeService::class);
            }
        );
        $this->app->bind(
            InterviewContract::class,
            function ($app) {
                return $app->make(InterviewService::class);
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
