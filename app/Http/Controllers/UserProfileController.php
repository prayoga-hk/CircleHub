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
        // Ambil semua postingan user ini, beserta gambar & user
        $posts = $user->posts()
            ->with(['images', 'user'])
            ->latest()
            ->get();

        return view('pages.users.show', compact('user', 'posts'));
    }
}