<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientJobController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::view('/', 'welcome');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profiles routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::view('/dashboard', 'client.dashboard')->name('dashboard');
        Route::resource('jobs', ClientJobController::class)->only(['index', 'create', 'show', 'store']);
    });

    Route::middleware('role:maalem')->prefix('maalem')->name('maalem.')->group(function () {
        Route::view('/dashboard', 'maalem.dashboard')->name('dashboard');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });
});
