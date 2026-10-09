<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Tampilkan profil publik user lain + postingannya.
     */
    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['user']) // hanya load 'user', relasi yang pasti ada
            ->latest()
            ->get();

        return view('pages.users.show', compact('user', 'posts'));
    }
}