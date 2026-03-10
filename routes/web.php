<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientJobController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->role === 'admin')
            return redirect()->route('admin.dashboard');

        if ($user->role === 'client') return redirect()->route('client.dashboard');
        if ($user->role === 'maalem') return redirect()->route('maalem.dashboard');

        return abort(403);

    })->name('dashboard');
});

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    Route::prefix('client/jobs')->name('client.jobs.')->group(function () {
        Route::get('/', [ClientJobController::class, 'index'])->name('index');
        Route::get('/create', [ClientJobController::class, 'create'])->name('create');
        Route::get('/{id}', [ClientJobController::class, 'show'])->name('show');
    });

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
