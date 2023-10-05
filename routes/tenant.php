<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Tenants\CategoriesController;
use App\Http\Controllers\Api\Tenants\LocationsController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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
    Route::get('/',function (){
        return 'tenant application'.tenant('id');
    });
});

Route::prefix('api')->middleware(['api', 'initialize.tenant'])->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
//    Route::post('forgot', [AuthController::class, 'forgot']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::apiResources(['category' => CategoriesController::class]);
        Route::apiResources(['location' => LocationsController::class]);
    });
});
