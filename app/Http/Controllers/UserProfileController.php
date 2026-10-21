<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()
            ->with(['user'])
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        return view('pages.users.show', compact('user', 'posts'));
    }
}
