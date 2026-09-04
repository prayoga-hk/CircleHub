<?php

<<<<<<< HEAD
=======
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StatisticController;
>>>>>>> 5f9be34 (perbaikan menu member dan kategori dan penambahan menu statistik pada dashboard)
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Route setelah login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Route Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route CRUD Category
    Route::resource('categories', CategoryController::class);
});

<<<<<<< HEAD
require __DIR__.'/auth.php';
=======
Route::middleware(['auth'])->prefix('dashboard')->name('admin.')->group(function () {


    Route::get('/statistik', [StatisticController::class, 'index'])->name('statistics.index');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
    Route::patch('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
    Route::patch('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__.'/auth.php';
>>>>>>> 5f9be34 (perbaikan menu member dan kategori dan penambahan menu statistik pada dashboard)
