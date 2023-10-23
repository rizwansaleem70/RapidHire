<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Tenants\CategoriesController;
use App\Http\Controllers\Api\Tenants\DepartmentsController;
use App\Http\Controllers\Api\Tenants\JobRequirementController;
use App\Http\Controllers\Api\Tenants\JobsController;
use App\Http\Controllers\Api\Tenants\JobShortlistingController;
use App\Http\Controllers\Api\Tenants\LocationsController;
use App\Http\Controllers\Api\Tenants\MemberController;
use App\Http\Controllers\Api\Tenants\QuestionBanksController;
use App\Http\Controllers\Api\Tenants\SettingsController;
use App\Http\Controllers\Api\Tenants\SocialMediasController;
use App\Http\Controllers\Api\Tenants\TestsController;
use App\Http\Controllers\Api\Tenants\TestServicesController;
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
    Route::get('/', [UserAuthController::class, 'home'])->name('tenant-user-home');
    Route::view('user-about', 'users/about')->name('tenant-user-about');
    Route::view('user-jobs', 'users/jobs')->name('tenant-user-jobs');
    Route::view('user-submit', 'users/submit')->name('tenant-user-submit');
    Route::view('user-contact-us', 'users/contact-us')->name('tenant-user-contact-us');
    Route::view('user-apply', 'users/apply')->name('tenant-user-apply');

    // Tenant Candidate User Auth Routes
    Route::get('user-signup', [UserAuthController::class, 'signup'])->name('tenant-user-signup');
    Route::post('user-signup', [Userauthcontroller::class, 'register'])->name('register-user');

    Route::get('user-login', [UserAuthController::class, 'loginPage'])->name('tenant-user-login');
    Route::post('user-login', [UserAuthController::class, 'login'])->name('tenant-user-login');

    Route::get('user-logout', [UserAuthController::class, 'logout'])->name('tenant-user-logout');

    Route::get('user-reset-password', [UserAuthController::class, 'resetPasswordPage'])->name('tenant-user-reset-password');
    Route::post('user-reset-password', [UserAuthController::class, 'resetPassword'])->name('tenant-user-reset-password');
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
        Route::apiResources(['job-requirement' => JobRequirementController::class]);
        Route::apiResources(['social-media' => SocialMediasController::class]);
        Route::apiResources(['setting' => SettingsController::class]);
        Route::apiResources(['members' => MemberController::class]);
        Route::apiResources(['question-bank' => QuestionBanksController::class]);
        Route::apiResources(['test-service' => TestServicesController::class]);
        Route::apiResources(['test' => TestsController::class]);
        Route::apiResources(['job-shortlisting' => JobShortlistingController::class]);
    });
});
