<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Passenger\DashboardController;

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

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('passenger.dashboard.index');
// Route::get('/driver/dashboard', [DriverDashboardController::class, 'index'])->name('driver.dashboard.index');
// Route::get('/driver/ride-histories', [DriverRideHistoryController::class, 'index'])->name('driver.ride-histories.index');
// Route::get('/driver/settings', [DriverSettingController::class, 'index'])->name('driver.settings.index');
// Route::get('/driver/login', [DriverAuthController::class, 'login'])->name('driver.login');
// Route::get('/driver/change-password', [DriverAccountController::class, 'changePassword'])->name('driver.change-password');
// Route::get('/driver/edit-profile', [DriverAccountController::class, 'editProfile'])->name('driver.edit-profile');

Route::get('/admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.process.login');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'view'])->name('admin.users.view');

    Route::get('/admin/admins', [AdminAdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admin/admins/add', [AdminAdminController::class, 'add'])->name('admin.admins.add');
    Route::get('/admin/admins/{id}', [AdminAdminController::class, 'view'])->name('admin.admins.view');
    Route::post('/admin/admins/store', [AdminAdminController::class, 'store'])->name('admin.admins.store');

    Route::get('/admin/ride-histories', [AdminRideHistoryController::class, 'index'])->name('admin.ride-histories.index');
    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::get('/admin/change-password', [AdminAccountController::class, 'changePassword'])->name('admin.change-password');

    Route::get('/admin/edit-profile', [AdminAccountController::class, 'editProfile'])->name('admin.edit-profile');
    Route::post('/admin/update-profile', [AdminAccountController::class, 'updateProfile'])->name('admin.account.update-profile');
    Route::post('/admin/update-change-password', [AdminAccountController::class, 'updatePassword'])->name('admin.account.update_change_password');

    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});