<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'images',
    ];

    /**
     * Cast kolom images ke array (menyimpan JSON / multiple images)
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Relasi ke Model User (Pemilik Postingan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Model Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Model Like
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relasi ke Model Comment
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Helper Method: Mengecek apakah postingan disukai oleh user tertentu
     */
    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
