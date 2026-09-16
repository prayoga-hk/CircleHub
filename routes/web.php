<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StatisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama / Landing Page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('pages.posts.index');
    }
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Rute Halaman Utama Forum
    Route::get('/home', [PostController::class, 'index'])->name('pages.posts.index');

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        return redirect()->route('admin.users.index');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
    return view('welcome');
});

// Route Profile (Wajib Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Prefix: /dashboard/...)
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard')->name('admin.')->group(function () {
        // Statistik
        Route::get('/statistik', [StatisticController::class, 'index'])->name('statistics.index');

        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
        Route::patch('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

        // Category Management (Admin)
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

});

require __DIR__.'/auth.php';