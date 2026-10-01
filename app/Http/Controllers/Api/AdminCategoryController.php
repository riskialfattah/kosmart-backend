<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat kategori.',
            ], 403);
        }

        $categories = Category::latest()->get();

        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function show(Request $request, Category $category)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat detail kategori.',
            ], 403);
        }

        return response()->json([
            'category' => $category,
        ]);
    }

    public function store(Request $request)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat menambah kategori.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'category' => $category,
        ], 201);
    }

    public function update(Request $request, Category $category)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat mengubah kategori.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui',
            'category' => $category,
        ]);
    }

    public function destroy(Request $request, Category $category)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat menghapus kategori.',
            ], 403);
        }

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus',
        ]);
    }
}