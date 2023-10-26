<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Tenants\CategoriesController;
use App\Http\Controllers\Api\Tenants\ColorSchemesController;
use App\Http\Controllers\Api\Tenants\DepartmentsController;
use App\Http\Controllers\Api\Tenants\HomesController;
use App\Http\Controllers\Api\Tenants\ImageUploadsController;
use App\Http\Controllers\Api\Tenants\InterviewFeedbacksController;
use App\Http\Controllers\Api\Tenants\JobRequirementController;
use App\Http\Controllers\Api\Tenants\JobsController;
use App\Http\Controllers\Api\Tenants\JobShortlistingController;
use App\Http\Controllers\Api\Tenants\LocationsController;
use App\Http\Controllers\Api\Tenants\LogosController;
use App\Http\Controllers\Api\Tenants\MemberController;
use App\Http\Controllers\Api\Tenants\OrganizationsController;
use App\Http\Controllers\Api\Tenants\QuestionBanksController;
use App\Http\Controllers\Api\Tenants\RequirementsController;
use App\Http\Controllers\Api\Tenants\SettingsController;
use App\Http\Controllers\Api\Tenants\SocialMediasController;
use App\Http\Controllers\Api\Tenants\TestsController;
use App\Http\Controllers\Api\Tenants\TestServicesController;
use App\Http\Controllers\Tenant\User\HomeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenant\User\UserAuthController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/
Route::middleware(['web',InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class,])->group(function () {
//    Route::get('/',function (){
//        return 'tenant application'.tenant('id');
//    });
    Route::get('/', [HomeController::class, 'index'])->name('tenant-user-home');

    Route::get('user-about', [HomeController::class, 'about'])->name('tenant-user-about');
    Route::get('user-contact-us', [HomeController::class, 'contact'])->name('tenant-user-contact-us');
    Route::get('user-jobs', [HomeController::class, 'jobs'])->name('tenant-user-jobs');
    Route::get('user-submit', [HomeController::class, 'submit'])->name('tenant-user-submit');
    Route::get('user-apply/{id}', [HomeController::class, 'jobApply'])->name('tenant-user-apply');

    // Tenant Candidate User Auth Routes
    Route::get('user-signup', [UserAuthController::class, 'signup'])->name('tenant-user-signup');
    Route::post('user-signup', [UserAuthController::class, 'register'])->name('register-user');

    Route::get('user-login', [UserAuthController::class, 'loginPage'])->name('tenant-user-login');
    Route::post('user-login', [UserAuthController::class, 'login'])->name('tenant-user-login');

    Route::get('user-logout', [UserAuthController::class, 'logout'])->name('tenant-user-logout');

    Route::get('user-reset-password', [UserAuthController::class, 'resetPasswordPage'])->name('tenant-user-reset-password');
    Route::post('user-reset-password', [UserAuthController::class, 'resetPassword'])->name('tenant-user-reset-password');

    Route::post('like-job',[HomeController::class,'like'])->name('user-like-job');
    Route::post('dislike-job',[HomeController::class,'dislike'])->name('user-dislike-job');
});

Route::prefix('api')->middleware(['initialize.tenant'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    //    Route::post('forgot', [AuthController::class, 'forgot']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('change-password', [AuthController::class, 'changePassword']);
        Route::get('delete-profile', [AuthController::class, 'deleteProfile']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::apiResources(['category' => CategoriesController::class]);
        Route::apiResources(['location' => LocationsController::class]);
        Route::apiResources(['job' => JobsController::class]);
        Route::post('question-list/{id?}' , [JobsController::class,'questionList']);
        Route::apiResources(['department' => DepartmentsController::class]);
        Route::apiResources(['requirement' => RequirementsController::class]);
        Route::apiResources(['social-media' => SocialMediasController::class]);
        Route::apiResources(['members' => MemberController::class]);
        Route::apiResources(['question-bank' => QuestionBanksController::class]);
        Route::apiResources(['test-service' => TestServicesController::class]);
        Route::apiResources(['test' => TestsController::class]);
        Route::apiResources(['job-shortlisting' => JobShortlistingController::class]);
        Route::get('settings/{type}', [SettingsController::class,'index']);
        Route::post('settings/{type}', [SettingsController::class,'store']);
        Route::apiResources(['interview-feedback' => InterviewFeedbacksController::class]);
        Route::post('image-upload' ,[ImageUploadsController::class,'store']);
    });
});
