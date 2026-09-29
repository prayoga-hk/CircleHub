<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori
     */
    public function index()
    {
        // Memuat kategori beserta jumlah postingan (posts_count)
        $categories = Category::withCount('posts')->latest()->get();

        // Mengarahkan ke view admin/categories/index.blade.php
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan detail kategori dan daftar postingan di dalamnya
     */
    public function show($id)
    {
        // Mengambil kategori berdasarkan ID beserta postingan terkait
        $category = Category::with('posts')->findOrFail($id);

        // Mengarahkan ke view admin/categories/show.blade.php
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Form tambah kategori (Admin)
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan kategori baru (Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Form edit kategori (Admin)
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mengubah data kategori (Admin)
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori (Admin)
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}