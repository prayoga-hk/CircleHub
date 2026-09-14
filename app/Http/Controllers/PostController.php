<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Menampilkan halaman utama forum beserta daftar postingan.
     */
    public function index()
    {
        // Ambil data post dari database diurutkan dari yang terbaru,
        // beserta relasi user-nya agar nama dan profil penulisnya bisa ditampilkan.
        $posts = Post::with('user')->latest()->get();

        return view('pages.posts.index', compact('posts'));
    }
}
