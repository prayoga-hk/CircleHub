<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login-custom');
    }

    /**
     * Handle an incoming authentication request.
     */
     public function store(Request $request): RedirectResponse
     {
         $request->validate([
             'login'    => ['required', 'string'],
             'password' => ['required', 'string'],
         ]);

         // Cek login via email atau username (name)
         $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

         $credentials = [
             $loginType => $request->input('login'),
             'password' => $request->input('password'),
         ];

         if (Auth::attempt($credentials, $request->boolean('remember'))) {
             $request->session()->regenerate();

             $user = Auth::user();

             if ($user->role === 'admin') {
                 return redirect()->route('admin.statistics.index');
             }

             return redirect('/');
         }

         return back()->withErrors([
             'login' => 'Username atau Password yang kamu masukkan salah.',
         ])->onlyInput('login');
     }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
