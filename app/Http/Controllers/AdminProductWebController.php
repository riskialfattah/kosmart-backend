<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminProductWebController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'user',
            'category',
            'images'
        ])
        ->latest()
        ->get();

        return view('admin.products', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load([
            'user',
            'category',
            'images'
        ]);

        return view('admin.product-detail', compact('product'));
    }

    // Fungsi destroy sekarang berada DI DALAM class (sebelum kurung kurawal terakhir)
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect('/admin/products')->with('success', 'Produk berhasil dihapus.');
    }
}