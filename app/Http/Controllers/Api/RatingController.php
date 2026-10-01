<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $user = $request->user();

        // User tidak boleh memberi rating kepada dirinya sendiri
        if ($product->user_id === $user->id) {
            return response()->json([
                'message' => 'Anda tidak dapat memberikan rating pada produk sendiri.',
            ], 403);
        }

        // Cek apakah user sudah pernah memberikan rating
        $existingRating = Rating::where('product_id', $product->id)
            ->where('reviewer_id', $user->id)
            ->first();

        if ($existingRating) {
            return response()->json([
                'message' => 'Anda sudah memberikan rating untuk produk ini.',
            ], 409);
        }

        $rating = Rating::create([
            'product_id' => $product->id,
            'reviewer_id' => $user->id,
            'seller_id' => $product->user_id,
            'rating' => $validated['rating'],
            'review' => $validated['review'] ?? null,
        ]);

        $rating->load([
            'reviewer',
            'seller',
            'product',
        ]);

        return response()->json([
            'message' => 'Rating berhasil diberikan',
            'rating' => $rating,
        ], 201);
    }

        public function index(Product $product)
    {
        $ratings = Rating::with([
            'reviewer',
            'seller',
        ])
        ->where('product_id', $product->id)
        ->latest()
        ->get();

        return response()->json([
            'product' => $product,
            'ratings' => $ratings,
        ]);
    }
}