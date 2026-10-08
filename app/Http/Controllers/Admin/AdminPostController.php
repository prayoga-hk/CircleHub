<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    /**
     * Tampilkan daftar postingan.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Hapus postingan beserta file gambarnya.
     */
    public function destroy(Post $post)
    {
        if ($post->images) {
            if (is_array($post->images)) {
                foreach ($post->images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            else {
                Storage::disk('public')->delete($post->images);
            }
        }

        $post->delete();

        return back()->with('success', 'Postingan berhasil dihapus.');
    }
}
