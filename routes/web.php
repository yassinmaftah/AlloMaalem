<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/complete-profile', [ProfileController::class, 'create'])->name('profile.complete');
    Route::post('/complete-profile', [ProfileController::class, 'store'])->name('profile.complete.store');


    Route::get('/dashboard', function () {

        /** @var \App\Models\User $user */
        $user = auth()->user();


        if ($user->role === 'admin')
            return redirect()->route('admin.dashboard');

        // this route check if the user maalem and client complate entre all info or not .
        if (!$user->info_done)
            return redirect()->route('profile.complete');

        if ($user->role === 'client') return redirect()->route('client.dashboard');
        if ($user->role === 'maalem') return redirect()->route('maalem.dashboard');

        return abort(403);

    })->name('dashboard');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

Route::middleware(['auth', 'role:maalem'])->group(function () {
    Route::get('/maalem/dashboard', function () {
        return view('maalem.dashboard');
    })->name('maalem.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/', function () {
    return view('welcome');
});
