<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->latest()->get();

        return view('pages.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with(['posts' => function ($query) {
            $query->with('user')->latest();
        }])->findOrFail($id);

        return view('pages.categories.show', compact('category'));
    }
}
