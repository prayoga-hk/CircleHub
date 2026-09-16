<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Menampilkan halaman utama forum beserta daftar postingan.
     */
    public function index()
    {
        // Ambil data post dari database diurutkan dari yang terbaru,
        // beserta relasi user dan category-nya.
        $posts = Post::with(['user', 'category'])->latest()->get();

        return view('pages.posts.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat postingan baru.
     */
    public function create()
    {
        // Ambil semua kategori untuk dropdown di form
        $categories = Category::orderBy('name')->get();

        return view('pages.posts.create', compact('categories'));
    }

    /**
     * Menyimpan postingan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Upload Image (Jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // 3. Simpan ke Database
        Post::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title) . '-' . time(),
            'content'     => $request->content,
            'image'       => $imagePath,
        ]);

        // 4. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pages.posts.index')->with('success', 'Postingan berhasil dibuat!');
    }
}
