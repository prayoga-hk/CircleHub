<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\PostCommented;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        Activity::create([
            'user_id'   => auth()->id(),
            'type'      => 'comment',
            'target_id' => $post->id,
            'metadata'  => [
                'post_title' => $post->title,
                'body'       => Str::limit($comment->body, 80),
            ],
        ]);

        if ($post->user_id !== auth()->id()) {
            $post->user->notify(new PostCommented($post, auth()->user(), $comment));
        }

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

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
