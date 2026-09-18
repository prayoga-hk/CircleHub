<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relasi ke model Comment (Satu Post memiliki banyak Komentar)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relasi ke model Like
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relasi ke User pembuat post
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}