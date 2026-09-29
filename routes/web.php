<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StatisticController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Wajib Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard Redirect
    Route::get('/dashboard', function () {
        return redirect()->route('admin.statistics.index');
    })->name('dashboard');

    // Posts (Postingan Utama & Home)
    Route::get('/home', [PostController::class, 'index'])->name('home');
    
    // Alias Pengaman
    Route::get('/posts-index', [PostController::class, 'index'])->name('pages.posts.index');
    
    Route::get('/posts/create', [PostController::class, 'create'])->name('pages.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('pages.posts.store');
    
    // Detail/Komentar & Like Postingan
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('pages.posts.show');
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Fitur Kategori untuk Pengguna (User Level)
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Prefix: /dashboard/..., Name: admin.)
    |--------------------------------------------------------------------------
    */
    Route::prefix('dashboard')->middleware('admin')->name('admin.')->group(function () {

        // Statistik
        Route::get('/statistik', [StatisticController::class, 'index'])->name('statistics.index');

        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
        Route::patch('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

        // Post Management
        Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
        Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');

        // Category Management (Admin CRUD)
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});

require __DIR__.'/auth.php';