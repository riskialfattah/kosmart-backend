<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with([
            'product.user',
            'product.category',
            'product.images'
        ])
        ->where('user_id', $request->user()->id)
        ->latest()
        ->get();

        return response()->json([
            'favorites' => $favorites,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $user = $request->user();

        $favorite = Favorite::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke favorit',
            'favorite' => $favorite,
        ], 201);
    }

    public function destroy(Request $request, Product $product)
    {
        $user = $request->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if (!$favorite) {
            return response()->json([
                'message' => 'Produk belum ada di favorit.',
            ], 404);
        }

        $favorite->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus dari favorit.',
        ]);
    }
}