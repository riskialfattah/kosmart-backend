<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WantedItem;
use Illuminate\Http\Request;

class AdminWantedItemController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat semua posting Dicari.',
            ], 403);
        }

        $wantedItems = WantedItem::with('user')
            ->latest()
            ->get();

        return response()->json([
            'wanted_items' => $wantedItems,
        ]);
    }

    public function show(Request $request, WantedItem $wantedItem)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat detail posting Dicari.',
            ], 403);
        }

        $wantedItem->load('user');

        return response()->json([
            'wanted_item' => $wantedItem,
        ]);
    }

    public function updateStatus(Request $request, WantedItem $wantedItem)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat mengubah status posting Dicari.',
            ], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:active,fulfilled,closed',
        ]);

        $wantedItem->update([
            'status' => $validated['status'],
        ]);

        $wantedItem->load('user');

        return response()->json([
            'message' => 'Status posting Dicari berhasil diperbarui',
            'wanted_item' => $wantedItem,
        ]);
    }

    public function destroy(Request $request, WantedItem $wantedItem)
    {
        $admin = $request->user();

        if ($admin->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat menghapus posting Dicari.',
            ], 403);
        }

        $wantedItem->delete();

        return response()->json([
            'message' => 'Posting Dicari berhasil dihapus',
        ]);
    }
}