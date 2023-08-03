<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('Super-Admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('SuperAdmin');
Route::get('All-Tenants', [App\Http\Controllers\HomeController::class, 'tenant'])->name('tenant.index');

Route::get('Create-Tenant', [App\Http\Controllers\TenantController::class, 'create'])->name('tenant.create');
Route::post('Create-Tenant', [App\Http\Controllers\TenantController::class, 'store'])->name('tenant.store');

Route::get('All-Users', [App\Http\Controllers\TenantUserController::class, 'user'])->name('user.index');

Route::get('Create-User', [App\Http\Controllers\TenantUserController::class, 'create'])->name('user.create');
Route::post('Create-User', [App\Http\Controllers\TenantUserController::class, 'store'])->name('user.store');
