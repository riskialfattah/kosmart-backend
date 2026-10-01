<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $user = $request->user();

        if ($product->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menambahkan gambar pada produk ini.',
            ], 403);
        }

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $validated['image']->store('products', 'public');

        $productImage = ProductImage::create([
            'product_id' => $product->id,
            'image' => $path,
        ]);

        return response()->json([
            'message' => 'Gambar produk berhasil ditambahkan',
            'image' => $productImage,
        ], 201);
    }

    public function destroy(Request $request, ProductImage $productImage)
    {
        $user = $request->user();

        if (
            $productImage->product->user_id !== $user->id
            && $user->role !== 'admin'
        ) {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus gambar ini.',
            ], 403);
        }

        Storage::disk('public')->delete($productImage->image);

        $productImage->delete();

        return response()->json([
            'message' => 'Gambar produk berhasil dihapus',
        ]);
    }
}