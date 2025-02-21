<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'redirect'])
    ->middleware('auth')
    ->name('dashboard.redirect');

// Role-specific routes
Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [UserController::class, 'adminDashboard'])
            ->name('adminDashboard');
    });

    // Agent routes
    Route::prefix('agent')->middleware('role:agent')->group(function () {
        Route::get('/dashboard', [UserController::class, 'agentDashboard'])
            ->name('agentDashboard');
    });

    // User routes
    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])
            ->name('userDashboard');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
