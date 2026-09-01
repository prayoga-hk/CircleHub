<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegisterForm()
    {
        return view('auth.register-custom');
    }

    // Memproses data registrasi
    public function register(Request $request)
    {
        // 1. Validasi Input Data
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan User Baru ke Database
        $user = User::create([
            'name'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Auto Login setelah Registrasi
        Auth::login($user);

        // 4. Redirect ke Halaman Beranda / Dashboard
        return redirect()->route('dashboard')->with('success', 'Selamat datang di CircleHub!');
    }
}