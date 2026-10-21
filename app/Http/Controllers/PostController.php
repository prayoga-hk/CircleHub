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
                $imagePaths[] = $file->store('posts', 'public');
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

    public function toggleLike(Post $post)
    {
        $userId = auth()->id();
        $existingLike = $post->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            $existingLike->delete();
            $isLiked = false;
        } else {
            $post->likes()->create(['user_id' => $userId]);
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

    public function edit(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403, 'Anda bukan pemilik postingan ini.');

        $categories = Category::all();

        return view('pages.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403, 'Anda bukan pemilik postingan ini.');

        $request->validate([
            'category_id'     => 'nullable|exists:categories,id',
            'title'           => 'nullable|string|max:255',
            'content'         => 'required|string',
            'images.*'        => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_images'   => 'nullable|array',
            'remove_images.*' => 'string',
        ]);

        $imagePaths = is_array($post->images) ? $post->images : [];

        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $path) {
                if (in_array($path, $imagePaths, true)) {
                    Storage::disk('public')->delete($path);
                    $imagePaths = array_values(array_filter($imagePaths, fn ($p) => $p !== $path));
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('posts', 'public');
            }
        }

        $post->update([
            'category_id' => $request->filled('category_id') ? $request->category_id : $post->category_id,
            'title'       => $request->title,
            'content'     => $request->content,
            'images'      => $imagePaths,
        ]);

        return redirect()->route('users.show', $post->user_id)
                         ->with('success', 'Postingan berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        abort_unless($post->user_id === auth()->id(), 403, 'Anda bukan pemilik postingan ini.');

        if (!empty($post->images) && is_array($post->images)) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $post->likes()->delete();
        $post->comments()->delete();
        $post->delete();

        return back()->with('success', 'Postingan berhasil dihapus.');
    }
}
