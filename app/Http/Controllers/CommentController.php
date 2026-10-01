<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Notifications\PostCommented; // ← tambahkan
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Menyimpan komentar baru ke database.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'body'    => $request->body,
        ]);

        if ($post->user_id !== auth()->id()) {
            $post->user->notify(new PostCommented($post, auth()->user(), $comment));
        }

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
