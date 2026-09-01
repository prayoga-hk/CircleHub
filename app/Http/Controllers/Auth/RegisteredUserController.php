<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-custom');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Mendukung penamaan 'username' maupun 'name' dari form
        $request->validate([
            'username' => ['nullable', 'string', 'max:255'],
            'name'     => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Mengambil input username (apapun nama atributnya di form)
        $usernameInput = $request->input('username') ?? $request->input('name');

        // Jika user tidak mengisi username sama sekali
        if (empty($usernameInput)) {
            return back()->withErrors(['username' => 'The username field is required.'])->withInput();
        }

        // Menyimpan data ke database
        $user = User::create([
            'name'     => $usernameInput,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}