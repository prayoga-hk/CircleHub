<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Menampilkan daftar postingan di beranda dengan Fitur Pencarian
     * (Mencakup pencarian berdasarkan Username, Judul, dan Konten)
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category'])
            ->withCount(['likes', 'comments']);

        // Filter pencarian jika terdapat query search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $posts = $query->latest()->get();

        // Mengecek apakah postingan sudah di-like oleh user yang sedang login
        if (auth()->check()) {
            $userId = auth()->id();
            $posts->each(function ($post) use ($userId) {
                $post->is_liked_by_user = $post->likes()->where('user_id', $userId)->exists();
            });
        }

        return view('pages.posts.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat postingan baru
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.posts.create', compact('categories'));
    }

    /**
     * Menyimpan postingan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'nullable|string|max:255',
            'content'     => 'required|string',
            'images.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('posts', 'public');
                $imagePaths[] = $path;
            }
        }

        // Generate slug unik berbasis judul atau konten jika judul kosong
        $titleForSlug = $request->title ?: Str::limit($request->content, 20, '');
        $slug = Str::slug($titleForSlug) . '-' . Str::random(5);

        Post::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'content'     => $request->content,
            'images'      => $imagePaths,
        ]);

        return redirect()->route('pages.posts.index')->with('success', 'Postingan berhasil dibuat!');
    }

    /**
     * Menampilkan detail postingan beserta komentar
     */
    public function show(Post $post)
    {
        $post->load(['user', 'category', 'comments.user']);
        $post->loadCount(['likes', 'comments']);

        if (auth()->check()) {
            $post->is_liked_by_user = $post->likes()->where('user_id', auth()->id())->exists();
        }

        return view('pages.posts.show', compact('post'));
    }

    /**
     * Fitur Toggle Like / Unlike Postingan (Mendukung Request Biasa & AJAX/Fetch)
     */
    public function toggleLike(Post $post)
    {
        $userId = auth()->id();

        // Mengecek apakah user sudah menyukai postingan ini
        $existingLike = $post->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            // Jika sudah di-like, hapus (Unlike)
            $existingLike->delete();
            $isLiked = false;
        } else {
            // Jika belum di-like, tambahkan ke tabel likes
            $post->likes()->create([
                'user_id' => $userId,
            ]);
            $isLiked = true;
        }

        // Respons JSON jika dipanggil via Fetch API / AJAX (agar tidak reload halaman)
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success'    => true,
                'isLiked'    => $isLiked,
                'likesCount' => $post->likes()->count(),
            ]);
        }

        return back();
    }
}