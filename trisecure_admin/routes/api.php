<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Passenger\Mobile\MobileAccountController;
use App\Http\Controllers\Passenger\Mobile\MobileAuthController;
use App\Http\Controllers\Driver\Mobile\MobileDriverAccountController;
use App\Http\Controllers\Driver\Mobile\MobileDriverAuthController;

Route::prefix('passengers')->group(function () {
    Route::get('/test', [MobileAuthController::class, 'test'])->name('passengers.test');
    Route::post('/login', [MobileAuthController::class, 'login'])->name('passengers.login');
    Route::post('/register', [MobileAuthController::class, 'register'])->name('passengers.register');
});

Route::prefix('drivers')->group(function () {
    Route::get('/test', [MobileDriverAuthController::class, 'test'])->name('drivers.test');
    Route::post('/login', [MobileDriverAuthController::class, 'login'])->name('drivers.login');
    Route::post('/register', [MobileDriverAuthController::class, 'register'])->name('drivers.register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('passengers')->group(function () {
        Route::get('/index', [MobileAuthController::class, 'index'])->name('passengers.index');

        Route::post('/edit-profile', [MobileAccountController::class, 'editProfile'])->name('passengers.edit-profile');
        Route::post('/change-password', [MobileAccountController::class, 'changePassword'])->name('passengers.change-password');

        Route::get('/logout', [MobileAuthController::class, 'logout'])->name('passengers.logout');
    });
    Route::prefix('drivers')->group(function () {
        Route::get('/index', [MobileDriverAuthController::class, 'index'])->name('drivers.index');

        Route::post('/edit-profile', [MobileDriverAccountController::class, 'editProfile'])->name('drivers.edit-profile');
        Route::post('/change-password', [MobileDriverAccountController::class, 'changePassword'])->name('drivers.change-password');

        Route::get('/logout', [MobileDriverAuthController::class, 'logout'])->name('drivers.logout');
    });
});
