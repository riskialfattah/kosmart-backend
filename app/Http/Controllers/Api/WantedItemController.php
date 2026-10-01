<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WantedItem;
use Illuminate\Http\Request;

class WantedItemController extends Controller
{
    public function index()
    {
        $wantedItems = WantedItem::with('user')
            ->where('status', 'active')
            ->latest()
            ->get();

        return response()->json([
            'wanted_items' => $wantedItems,
        ]);
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'budget' => 'required|numeric|min:0',
            'condition' => 'required|in:baru,bekas_baik,bekas_layak',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
        ]);

        $wantedItem = WantedItem::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'budget' => $validated['budget'],
            'condition' => $validated['condition'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'] ?? null,
            'status' => 'active',
        ]);

        $wantedItem->load('user');

        return response()->json([
            'message' => 'Posting Dicari berhasil dibuat',
            'wanted_item' => $wantedItem,
        ], 201);
    }

        public function update(Request $request, WantedItem $wantedItem)
    {
        $user = $request->user();

        if ($wantedItem->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk mengubah posting ini.',
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'budget' => 'required|numeric|min:0',
            'condition' => 'required|in:baru,bekas_baik,bekas_layak',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:150',
            'status' => 'nullable|in:active,fulfilled,closed',
        ]);

        $wantedItem->update($validated);

        $wantedItem->load('user');

        return response()->json([
            'message' => 'Posting Dicari berhasil diperbarui',
            'wanted_item' => $wantedItem,
        ]);
    }

        public function destroy(Request $request, WantedItem $wantedItem)
    {
        $user = $request->user();

        if ($wantedItem->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus posting ini.',
            ], 403);
        }

        $wantedItem->delete();

        return response()->json([
            'message' => 'Posting Dicari berhasil dihapus',
        ]);
    }

        public function show(WantedItem $wantedItem)
    {
        $wantedItem->load('user');

        return response()->json([
            'wanted_item' => $wantedItem,
        ]);
    }
}