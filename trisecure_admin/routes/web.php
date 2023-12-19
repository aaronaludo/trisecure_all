<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Passenger\DashboardController;
use App\Http\Controllers\Passenger\AccountController;
use App\Http\Controllers\Passenger\AuthController;
use App\Http\Controllers\Passenger\RideHistoryController;
use App\Http\Controllers\Passenger\SettingController;
use App\Http\Controllers\Passenger\ConnectionController;

use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\Driver\DriverAccountController;
use App\Http\Controllers\Driver\DriverAuthController;
use App\Http\Controllers\Driver\DriverRideHistoryController;
use App\Http\Controllers\Driver\DriverSettingController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRideHistoryController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/passenger/login', [AuthController::class, 'index'])->name('passenger.login');
Route::post('/passenger/login', [AuthController::class, 'login'])->name('passenger.process.login');
Route::get('/passenger/register', [AuthController::class, 'register'])->name('passenger.register');
Route::post('/passenger/register', [AuthController::class, 'store'])->name('passenger.process.store');

Route::get('/driver/login', [DriverAuthController::class, 'index'])->name('driver.login');
Route::post('/driver/login', [DriverAuthController::class, 'login'])->name('driver.process.login');
Route::get('/driver/register', [DriverAuthController::class, 'register'])->name('driver.register');
Route::post('/driver/register', [DriverAuthController::class, 'store'])->name('driver.process.store');

Route::get('/admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.process.login');

Route::middleware(['auth:passenger'])->group(function () {
    Route::get('/passenger/dashboard', [DashboardController::class, 'index'])->name('passenger.dashboard.index');

    Route::get('/passenger/ride-histories', [RideHistoryController::class, 'index'])->name('passenger.ride-histories.index');
    Route::get('/passenger/ride-histories/search', [RideHistoryController::class, 'search'])->name('passenger.ride-histories.search');
    Route::get('/passenger/ride-histories/{id}', [RideHistoryController::class, 'view'])->name('passenger.ride-histories.view');
    
    Route::get('/passenger/connects', [ConnectionController::class, 'index'])->name('passenger.connects.index');

    Route::get('/passenger/settings', [SettingController::class, 'index'])->name('passenger.settings.index');

    Route::get('/passenger/change-password', [AccountController::class, 'changePassword'])->name('passenger.change-password');
    Route::get('/passenger/edit-profile', [AccountController::class, 'editProfile'])->name('passenger.edit-profile');
    Route::post('/passenger/update-profile', [AccountController::class, 'updateProfile'])->name('passenger.account.update-profile');
    Route::post('/passenger/update-change-password', [AccountController::class, 'updatePassword'])->name('passenger.account.update_change_password');

    Route::post('/passenger/logout', [AuthController::class, 'logout'])->name('passenger.logout');
});

Route::middleware(['auth:driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard.index');

    Route::get('/driver/ride-histories', [DriverRideHistoryController::class, 'index'])->name('driver.ride-histories.index');
    Route::get('/driver/ride-histories/search', [DriverRideHistoryController::class, 'search'])->name('driver.ride-histories.search');
    Route::get('/driver/ride-histories/{id}', [DriverRideHistoryController::class, 'view'])->name('driver.ride-histories.view');
    
    Route::get('/driver/settings', [DriverSettingController::class, 'index'])->name('driver.settings.index');

    Route::get('/driver/change-password', [DriverAccountController::class, 'changePassword'])->name('driver.change-password');
    Route::get('/driver/edit-profile', [DriverAccountController::class, 'editProfile'])->name('driver.edit-profile');
    Route::post('/driver/update-profile', [DriverAccountController::class, 'updateProfile'])->name('driver.account.update-profile');
    Route::post('/driver/update-change-password', [DriverAccountController::class, 'updatePassword'])->name('driver.account.update_change_password');

    Route::post('/driver/logout', [DriverAuthController::class, 'logout'])->name('driver.logout');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/search', [AdminUserController::class, 'search'])->name('admin.users.search');
    Route::post('/admin/users/verify/{id}', [AdminUserController::class, 'verify'])->name('admin.users.verify');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');

    Route::get('/admin/admins', [AdminAdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admin/admins/add', [AdminAdminController::class, 'add'])->name('admin.admins.add');
    Route::get('/admin/admins/{id}', [AdminAdminController::class, 'view'])->name('admin.admins.view');
    Route::post('/admin/admins/store', [AdminAdminController::class, 'store'])->name('admin.admins.store');

    Route::get('/admin/ride-histories', [AdminRideHistoryController::class, 'index'])->name('admin.ride-histories.index');
    Route::get('/admin/ride-histories/{id}', [AdminRideHistoryController::class, 'view'])->name('admin.ride-histories.view');

    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');

    Route::get('/admin/change-password', [AdminAccountController::class, 'changePassword'])->name('admin.change-password');
    Route::get('/admin/edit-profile', [AdminAccountController::class, 'editProfile'])->name('admin.edit-profile');
    Route::post('/admin/update-profile', [AdminAccountController::class, 'updateProfile'])->name('admin.account.update-profile');
    Route::post('/admin/update-change-password', [AdminAccountController::class, 'updatePassword'])->name('admin.account.update_change_password');

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});