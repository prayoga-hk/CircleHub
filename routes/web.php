<?php

use App\Http\Controllers\AuthController;

// Route Tampilan & Proses Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Dummy Route untuk Login dan Dashboard
Route::get('/login', function () { return "Halaman Login"; })->name('login');
Route::get('/dashboard', function () { return "Selamat Datang di Dashboard CircleHub!"; })->name('dashboard')->middleware('auth');


// Override route register bawaan Breeze
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
