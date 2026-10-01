<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat semua produk.',
            ], 403);
        }

        $products = Product::with([
            'user',
            'category',
            'images',
        ])
        ->latest()
        ->get();

        return response()->json([
            'products' => $products,
        ]);
    }

    public function show(Request $request, Product $product)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat detail produk.',
            ], 403);
        }

        $product->load([
            'user',
            'category',
            'images',
        ]);

        return response()->json([
            'product' => $product,
        ]);
    }

    public function destroy(Request $request, Product $product)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat menghapus produk.',
            ], 403);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}