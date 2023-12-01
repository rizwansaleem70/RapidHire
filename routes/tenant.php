<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Tenants\CategoriesController;
use App\Http\Controllers\Api\Tenants\DepartmentsController;
use App\Http\Controllers\Api\Tenants\HomeController;
use App\Http\Controllers\Api\Tenants\ImageUploadsController;
use App\Http\Controllers\Api\Tenants\InterviewFeedbacksController;
use App\Http\Controllers\Api\Tenants\InterviewsController;
use App\Http\Controllers\Api\Tenants\JobsController;
use App\Http\Controllers\Api\Tenants\JobShortlistingController;
use App\Http\Controllers\Api\Tenants\LocationsController;
use App\Http\Controllers\Api\Tenants\MemberController;
use App\Http\Controllers\Api\Tenants\PermissionsController;
use App\Http\Controllers\Api\Tenants\QuestionBanksController;
use App\Http\Controllers\Api\Tenants\RequirementsController;
use App\Http\Controllers\Api\Tenants\RoleController;
use App\Http\Controllers\Api\Tenants\SettingsController;
use App\Http\Controllers\Api\Tenants\SocialMediasController;
use App\Http\Controllers\Api\Tenants\TestsController;
use App\Http\Controllers\Api\Tenants\TestServicesController;
use App\Http\Controllers\Tenants\Candidate\ContactUsController;
use App\Http\Controllers\Tenants\Candidate\HomeController as CandidateHomeController;
use App\Http\Controllers\Tenants\Candidate\JobsController as CandidateJobsController;
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

Route::middleware(['web', InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class,])->group(function () {
    //    Route::get('/',function (){
    //        return 'tenant application'.tenant('id');
    //    });
    Route::get('/', [CandidateHomeController::class, 'home'])->name('candidate.home');
    Route::view('about', 'candidates/about')->name('candidate.user-about');
    Route::get('get-all-state-from-country', [HomeController::class, 'getAllStateCandidate'])->name('get-all-state-from-country');
    Route::get('get-all-city-from-state', [HomeController::class, 'getAllCityCandidate'])->name('get-all-city-from-state');
    Route::get('job', [CandidateJobsController::class, 'listing'])->name('candidate.job.list');
    Route::get('job-detail/{slug}', [CandidateJobsController::class, 'jobDetail'])->name('candidate.job.detail');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('job-apply/{slug}', [CandidateJobsController::class, 'jobApply'])->name('candidate.job.apply');
        Route::post('job-apply', [CandidateJobsController::class, 'jobApplyStore'])->name('candidate.job.apply.save');
    });
    Route::get('contact-us', [ContactUsController::class, 'contact_us'])->name('candidate.contact-us');
    Route::view('user-apply', 'candidates/apply')->name('tenant-user-apply');

    // Tenant Candidate User Auth Routes
    Route::get('user-signup', [UserAuthController::class, 'signup'])->name('tenant-user-signup');
    Route::post('user-signup', [UserAuthController::class, 'register'])->name('register-user');
    Route::get('login', [UserAuthController::class, 'loginPage'])->name('candidate.login');
    Route::post('user-login', [UserAuthController::class, 'login'])->name('tenant-user-login');

    Route::get('logout', [UserAuthController::class, 'logout'])->name('candidate.logout');

    Route::get('user-reset-password', [UserAuthController::class, 'resetPasswordPage'])->name('tenant-user-reset-password');
    Route::post('user-reset-password', [UserAuthController::class, 'resetPassword'])->name('tenant-user-reset-password');

    Route::post('like-job', [CandidateJobsController::class, 'like'])->name('user-like-job');
    Route::post('dislike-job', [CandidateJobsController::class, 'dislike'])->name('user-dislike-job');
});

Route::prefix('api')->middleware(['initialize.tenant'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    //    Route::post('forgot', [AuthController::class, 'forgot']);
    Route::get('dashboard-authenticate', [AuthController::class, 'dashboardAuthenticate']);

    Route::group(['middleware' => ['auth:sanctum', 'cors']], function () {
        Route::get('dashboard', [HomeController::class, 'getDashboardStats']);
        Route::get('candidate-dashboard/{user_id}', [HomeController::class, 'getCandidateDashboardStats']);
        Route::get('get-all-country', [HomeController::class, 'getAllCountry']);
        Route::get('get-all-state-from-country', [HomeController::class, 'getAllState']);
        Route::get('get-all-city-from-state', [HomeController::class, 'getAllCity']);
        Route::post('change-password/{user_id}', [AuthController::class, 'changePassword']);
        Route::post('delete-profile/{user_id}', [AuthController::class, 'deleteProfile']);
        Route::get('favorite-job', [AuthController::class, 'favoriteJob']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::apiResources(['category' => CategoriesController::class]);
        Route::apiResources(['location' => LocationsController::class]);
        Route::apiResources(['job' => JobsController::class]);
        Route::get('question-list', [JobsController::class, 'questionList']);
        Route::get('job-qualification/{job_id}/{applicant_id}', [JobsController::class, 'getJobQualifications']);
        Route::post('job-qualification/{job_id}', [JobsController::class, 'job_qualification']);
        Route::get('get-country-against-job/{id}', [JobsController::class, 'get_country_against_job']);
        Route::post('ATS-score/{job_id}', [JobsController::class, 'ATS_Score']);
        Route::apiResources(['roles' => RoleController::class]);
        Route::apiResources(['permissions' => PermissionsController::class]);
        Route::apiResources(['department' => DepartmentsController::class]);
        Route::apiResources(['requirement' => RequirementsController::class]);
        Route::apiResources(['social-media' => SocialMediasController::class]);
        Route::apiResources(['members' => MemberController::class]);
        Route::apiResources(['question-bank' => QuestionBanksController::class]);
        Route::apiResources(['test-service' => TestServicesController::class]);
        Route::apiResources(['test' => TestsController::class]);
        Route::apiResources(['job-shortlisting' => JobShortlistingController::class]);
        Route::get('settings', [SettingsController::class, 'index']);
        Route::post('settings/{type}', [SettingsController::class, 'store']);
        Route::apiResources(['interview-feedback' => InterviewFeedbacksController::class]);
        Route::post('image-upload', [ImageUploadsController::class, 'store']);
        Route::get('job/{id}/qualifications', [JobsController::class, 'getJobQualificationsForAts']);
        Route::get('job/{id}/requirements', [JobsController::class, 'requirements']);
        Route::get('applicants', [JobsController::class, 'getJobs']);
        Route::get('applicants/{job_id}', [JobsController::class, 'getJobApplicants']);
        Route::get('job-applicant-profile-header/{applicant_id}', [JobsController::class, 'jobApplicantProfileHeader']);
        Route::get('job-applicant-profile-status/{applicant_id}/{job_id}', [JobsController::class, 'jobApplicantProfileStatus']);
        Route::get('job-applicant-question-answer/{applicant_id}/{job_id}', [JobsController::class, 'jobApplicantQuestionAnswer']);
        Route::get('profile/{user_id}', [JobsController::class, 'profile']);
        Route::put('profile-update/{user_id}', [JobsController::class, 'profileUpdate']);
        Route::get('candidate-applied-jobs', [JobsController::class, 'candidateAppliedJobs']);
        // Route::get('test-services', [TestsController::class, 'getTestServices']);
        // Route::post('job/{id}/services-tests', [TestServicesController::class, 'saveJobServiceTests']);
        // Route::get('job/{id}/services-tests', [TestServicesController::class, 'getJobServiceTests']);
        Route::post('job/{id}/services-tests', [TestServicesController::class, 'saveJobServiceTests']);
        Route::get('job/{id}/services-tests', [TestServicesController::class, 'getJobServiceTests']);
        Route::post('schedule_interview', [InterviewsController::class, 'store']);
        Route::get('get_candidate_interviews/{applicant_id}', [InterviewsController::class, 'index']);
        Route::delete('schedule_interview/{id}', [InterviewsController::class, 'destroy']);
        Route::get('documents', [JobsController::class, 'getApplicantDocuments']);
    });
});
