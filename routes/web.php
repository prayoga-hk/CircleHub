<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return 'Selamat Datang di Dashboard CircleHub!';
})->middleware(['auth', 'verified'])->name('dashboard');

use Illuminate\Support\Facades\Auth;

Route::get('/force-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});


Route::get('/logout-custom', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

// PASTIKAN BARIS INI ADA DI PALING BAWAH
require __DIR__.'/auth.php';