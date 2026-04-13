<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\ClientJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Maalem\MaalemApplicationController;
use App\Http\Controllers\MaalemDashboardController;
use App\Http\Controllers\Maalem\MaalemJobController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSettingController;
Route::view('/', 'welcome');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
});

// forgot password routes (guest)
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('password.email.form');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendCode'])->name('password.send.code');
    Route::get('/verify-code', [ForgotPasswordController::class, 'showCodeForm'])->name('password.code.form');
    Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify.code');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
});

Route::middleware(['check.banned' , 'auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // profiles routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/profile/verify', [ProfileController::class, 'requestVerification'])->name('profile.verify');

    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::view('/dashboard', 'client.dashboard')->name('dashboard');
        Route::resource('jobs', ClientJobController::class)->only(['index', 'create', 'show', 'store', 'edit', 'update', 'destroy']);
        Route::post('/offer/{id}/accept', [ClientJobController::class, 'accept'])->name('offer.accept');
        Route::post('/offer/{id}/reject', [ClientJobController::class, 'reject'])->name('offer.reject');
        Route::post('/job/{id}/complete', [ClientJobController::class, 'complete'])->name('jobs.complete');
        Route::post('/job/{id}/review', [ClientJobController::class, 'review'])->name('jobs.review');
    });

    Route::middleware(['auth', 'role:maalem'])->prefix('maalem')->name('maalem.')->group(function () {

        Route::get('/dashboard', [MaalemDashboardController::class, 'index'])->name('dashboard');
        Route::get('/reviews', [MaalemDashboardController::class, 'reviews'])->name('reviews');

        Route::get('/find-work', [MaalemJobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{id}', [MaalemJobController::class, 'show'])->name('jobs.show');
        Route::post('/jobs/{id}/apply', [MaalemJobController::class, 'store'])->name('jobs.apply');

        Route::get('/my-apps', [MaalemApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{id}/edit', [MaalemApplicationController::class, 'edit'])->name('applications.edit');
        Route::put('/applications/{id}', [MaalemApplicationController::class, 'update'])->name('applications.update');
        Route::delete('/applications/{id}', [MaalemApplicationController::class, 'destroy'])->name('applications.destroy');
        Route::post('/applications/{id}/reapply', [MaalemApplicationController::class, 'reapply'])->name('applications.reapply');

    });

    Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/pending-requests', [AdminUserController::class, 'pendingRequests'])->name('requests.index');
        Route::post('/users/{id}/approve',  [AdminUserController::class, 'approve'])->name('users.approve');
        Route::post('/users/{id}/reject', [AdminUserController::class, 'reject'])->name('users.reject');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');

        Route::post('/users/{id}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::post('/users/{id}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');

        Route::post('/settings/categories', [AdminSettingController::class, 'storeCategory'])->name('categories.store');
        Route::post('/settings/categories/{id}/delete', [AdminSettingController::class, 'destroyCategory'])->name('categories.destroy');

        Route::post('/settings/cities', [AdminSettingController::class, 'storeCity'])->name('cities.store');
        Route::post('/settings/cities/{id}/delete', [AdminSettingController::class, 'destroyCity'])->name('cities.destroy');
    });
});
