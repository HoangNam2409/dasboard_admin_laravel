<?php

use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserCatalogueController;
use App\Http\Controllers\User\LanguageController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// AJAX
Route::post('/ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware(AuthenticateMiddleware::class);
Route::post('/ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware(AuthenticateMiddleware::class);
Route::get('/ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware(AuthenticateMiddleware::class);

// USERS
Route::prefix('user')->middleware([AuthenticateMiddleware::class])->group(function() {
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->where('id', '[0-9]+');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/index', [UserController::class, 'index'])->name('user.index');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

// USERS CATALOGUE
Route::prefix('user/catalogue')->middleware([AuthenticateMiddleware::class])->group(function() {
    Route::get('/delete/{id}', [UserCatalogueController::class, 'delete'])->name('user.catalogue.delete');
    Route::get('/edit/{id}', [UserCatalogueController::class, 'edit'])->name('user.catalogue.edit')->where('id', '[0-9]+');
    Route::get('/create', [UserCatalogueController::class, 'create'])->name('user.catalogue.create');
    Route::get('/index', [UserCatalogueController::class, 'index'])->name('user.catalogue.index');
    Route::post('/update/{id}', [UserCatalogueController::class, 'update'])->name('user.catalogue.update');
    Route::post('/store', [UserCatalogueController::class, 'store'])->name('user.catalogue.store');
    Route::delete('/destroy/{id}', [UserCatalogueController::class, 'destroy'])->name('user.catalogue.destroy');
});

// LANGUAGES
Route::prefix('language')->middleware([AuthenticateMiddleware::class])->group(function() {
    Route::get('/delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
    Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('language.edit')->where('id', '[0-9]+');
    Route::get('/create', [LanguageController::class, 'create'])->name('language.create');
    Route::get('/index', [LanguageController::class, 'index'])->name('language.index');
    Route::post('/update/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::post('/store', [LanguageController::class, 'store'])->name('language.store');
    Route::delete('/destroy/{id}', [LanguageController::class, 'destroy'])->name('language.destroy');
});

// Dashboard
Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')->middleware(AuthenticateMiddleware::class);

// Auth
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/page-login', [AuthController::class, 'index'])->name('auth.index')->middleware(LoginMiddleware::class);