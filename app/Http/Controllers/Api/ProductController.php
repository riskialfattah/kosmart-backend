<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with([
            'user',
            'category',
            'images',
        ])->where('status', 'available');

        // Pencarian berdasarkan nama atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'ILIKE', '%' . $search . '%')
                ->orWhere('description', 'ILIKE', '%' . $search . '%');
            });
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter kondisi
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Filter lokasi
        if ($request->filled('location')) {
            $query->where('location', 'ILIKE', '%' . $request->location . '%');
        }

        // Filter harga minimum
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter harga maksimum
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query
            ->latest()
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }


        public function myProducts(Request $request)
    {
        $products = Product::with([
            'category',
            'images',
        ])
        ->where('user_id', $request->user()->id)
        ->latest()
        ->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Product $product)
    {
        $product->load([
            'user:id,name,phone,location',
            'category:id,name',
            'images:id,product_id,image'
        ]);

        return response()->json([
            'message' => 'Detail produk berhasil diambil',
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:baru,bekas_baik,bekas_layak',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
        ]);

        $product = Product::create([
            'user_id' => $request->user()->id,
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'condition' => $validated['condition'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'] ?? null,
            'status' => 'available',
        ]);

        $product->load([
            'user:id,name,phone,location',
            'category:id,name',
            'images:id,product_id,image'
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'product' => $product,
        ], 201);
    }

    public function update(Request $request, Product $product)
    {
        $user = $request->user();

        if ($product->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk mengubah produk ini.',
            ], 403);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:baru,bekas_baik,bekas_layak',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
        ]);

        $product->update($validated);

        $product->load([
            'user:id,name,phone,location',
            'category:id,name',
            'images:id,product_id,image'
        ]);

        return response()->json([
            'message' => 'Produk berhasil diperbarui',
            'product' => $product,
        ]);
    }

    public function destroy(Request $request, Product $product)
    {
        $user = $request->user();

        if ($product->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus produk ini.',
            ], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
        ]);
    }

        public function markAsSold(Request $request, Product $product)
    {
        $user = $request->user();

        if ($product->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk mengubah status produk ini.',
            ], 403);
        }

        if ($product->status === 'sold') {
            return response()->json([
                'message' => 'Produk sudah ditandai sebagai terjual.',
            ], 400);
        }

        $product->update([
            'status' => 'sold',
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditandai sebagai terjual',
            'product' => $product,
        ]);
    }
}