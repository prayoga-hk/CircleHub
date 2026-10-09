<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Satu Kategori memiliki banyak Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Accessor: URL foto kategori
     * Dipakai di blade: $cat->image_url
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}