<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Menyimpan komentar baru ke database.
     */
    public function store(Request $request, Post $post)
    {
        // 1. Validasi input komentar
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // 2. Simpan komentar
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'body'    => $request->body,
        ]);

        // 3. Kembali ke halaman sebelumnya
        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}