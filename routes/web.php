<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'redirect'])
    ->middleware('auth')
    ->name('dashboard.redirect');

// Routes spécifiques aux rôles
Route::middleware(['auth', 'role'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [UserController::class, 'adminDashboard'])
            ->name('admin.dashboard');
    });

    Route::prefix('manager')->middleware('role:manager')->group(function () {
        Route::get('/dashboard', [UserController::class, 'managerDashboard'])
            ->name('manager.dashboard');
    });

    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::get('/dashboard', [UserController::class, 'userDashboard'])
            ->name('user.dashboard');
    });
});

    // User routes
    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::get('/', [UserController::class, 'userDashboard'])->name('user.dashboard');
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
