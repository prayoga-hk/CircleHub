<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category'])
            ->withCount(['likes', 'comments']);

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

        if (auth()->check()) {
            $userId = auth()->id();
            $posts->each(function ($post) use ($userId) {
                $post->is_liked_by_user = $post->likes()->where('user_id', $userId)->exists();
            });
        }

        return view('pages.posts.index', compact('posts'));
    }

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

        $titleForSlug = $request->title ?: Str::limit($request->content, 20, '');
        $slug = Str::slug($titleForSlug) . '-' . Str::random(5);

        $post = Post::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'content'     => $request->content,
            'images'      => $imagePaths,
        ]);

        Activity::create([
            'user_id'   => auth()->id(),
            'type'      => 'post',
            'target_id' => $post->id,
            'metadata'  => [
                'title' => $post->title ?: Str::limit($post->content, 60),
            ],
        ]);

        return redirect()->route('pages.posts.index')->with('success', 'Postingan berhasil dibuat!');
    }

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
     * Fitur Toggle Like / Unlike Postingan
     */
    public function toggleLike(Post $post)
    {
        $userId = auth()->id();

        $existingLike = $post->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;

        } else {
            $post->likes()->create([
                'user_id' => $userId,
            ]);
            $isLiked = true;

            Activity::create([
                'user_id'   => $userId,
                'type'      => 'like',
                'target_id' => $post->id,
                'metadata'  => [
                    'post_title' => $post->title ?: Str::limit($post->content, 60),
                ],
            ]);
        }

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
