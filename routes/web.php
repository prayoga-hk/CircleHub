<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('pages.posts.index');
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
        return redirect()->route('admin.users.index');
    })->name('dashboard');

    // Posts (Postingan)
    Route::get('/home', [PostController::class, 'index'])->name('pages.posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('pages.posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('pages.posts.store');

    // Fitur Detail/Komentar & Like Postingan
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('pages.posts.show');
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');

    // Fitur Simpan Komentar (Baru Ditambahkan)
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    //Fitur Kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('pages.categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('pages.categories.show');

    // Fitur Notifikasi
    Route::get('/pages/notification', [NotificationController::class, 'index'])->name('pages.notification');
    Route::get('/pages/notification/unread-count', [NotificationController::class, 'unreadCount'])->name('pages.notification.unreadCount');
    Route::get('/pages/notification/{id}/read', [NotificationController::class, 'read'])->name('pages.notification.read');
    Route::post('/pages/notification/read-all', [NotificationController::class, 'readAll'])->name('pages.notification.readAll');
});

    // Profile
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

        // Category Management
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
    });

require __DIR__.'/auth.php';
