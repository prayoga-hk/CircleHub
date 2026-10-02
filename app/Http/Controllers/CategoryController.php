<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil kategori berurutan A-Z beserta jumlah anggota/postingan
        $categories = Category::withCount('posts') // atau 'users' jika ada relasi member
            ->orderBy('name', 'asc')
            ->get();

        return view('pages.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('pages.categories.show', compact('category'));
    }
}