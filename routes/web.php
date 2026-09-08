<?php

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

require __DIR__.'/auth.php';