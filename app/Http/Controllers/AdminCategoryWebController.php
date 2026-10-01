<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryWebController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta jumlah produk di masing-masing kategori
        $categories = Category::withCount('products')->orderBy('id', 'asc')->get();
        
        return view('admin.categories', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.category-create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect('/admin/categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }

    // Menyimpan perubahan kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect('/admin/categories')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        // Mencegah penghapusan jika kategori masih memiliki produk
        if ($category->products()->count() > 0) {
            return redirect('/admin/categories')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $category->delete();
        return redirect('/admin/categories')->with('success', 'Kategori berhasil dihapus.');
    }
}