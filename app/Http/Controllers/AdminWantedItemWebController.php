<?php

namespace App\Http\Controllers;

use App\Models\WantedItem;
use Illuminate\Http\Request;

class AdminWantedItemWebController extends Controller
{
    public function index()
    {
        $wantedItems = WantedItem::with('user')->latest()->get();
        return view('admin.wanted-items', compact('wantedItems'));
    }

    // Fungsi baru untuk menampilkan detail Barang Dicari
    public function show(WantedItem $wantedItem)
    {
        $wantedItem->load('user');
        return view('admin.wanted-item-detail', compact('wantedItem'));
    }

    public function destroy(WantedItem $wantedItem)
    {
        $wantedItem->delete();
        return redirect('/admin/wanted-items')->with('success', 'Posting berhasil dihapus.');
    }
}
