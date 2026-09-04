<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// ke landing page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.users.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin panel
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('admin.')->group(function () {

    //manajemen member
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
    Route::patch('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
    Route::patch('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

    //manajemen kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

require __DIR__.'/auth.php';
