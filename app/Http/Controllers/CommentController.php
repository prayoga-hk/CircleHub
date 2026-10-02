<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Notifications\PostCommented;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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

        // ⬇️ TAMBAHKAN BLOK INI ⬇️
        if ($request->expectsJson()) {
            $comment->load('user');
            return response()->json([
                'success' => true,
                'comment' => [
                    'id'         => $comment->id,
                    'body'       => $comment->body,
                    'user_name'  => $comment->user->name,
                    'created_at' => $comment->created_at->diffForHumans(),
                ],
            ]);
        }

        // Fallback untuk submit form biasa (tanpa JS)
        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
