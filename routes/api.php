<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthTenantController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\TenantAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
 });
Route::post('login', [AuthController::class, 'login']);
Route::group(['prefix' => 'tenants','middleware' => 'auth:sanctum'], function () {
    Route::post('register', [AuthTenantController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout',[AuthController::class,'logout']);
    Route::post('profile/{id?}', [AuthController::class, 'update']);
    Route::get('profile', [AuthController::class, 'profile']);
});
// Route::middleware([
//     InitializeTenancyBySubdomain::class,
//     PreventAccessFromCentralDomains::class,
// ])->group(function () {
// Route::group([
//     'prefix' => '/{tenant}',
//     'middleware' => [InitializeTenancyByDomainOrSubdomain::class],
// ], function () {
//     Route::post('register', [AuthController::class, 'register']);
// });
//php artisan make:model Tenants/Test -m
//php artisan make:controller Api/Tenants/TestsController --api
//php artisan make:contract Test
//php artisan make:service Test
//php artisan make:resource Tenants/Test
//php artisan make:resource Tenants/TestCollection
//php artisan make:request Tenants/StoreTestRequest
//php artisan make:request Tenants/UpdateTestRequest
