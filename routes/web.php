<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// AJAX
Route::get('/ajax/location/getLocationDistrict', [LocationController::class, 'getLocationDistrict'])->name('ajax.location.district')->middleware(AuthenticateMiddleware::class);
Route::get('/ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware(AuthenticateMiddleware::class);

// USERS
Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware(AuthenticateMiddleware::class);
Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware(AuthenticateMiddleware::class);
Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware(AuthenticateMiddleware::class);

// Dashboard
Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);

// Auth
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/page-login', [AuthController::class, 'index'])->name('auth.index')->middleware(LoginMiddleware::class);