<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = $request->user();

        // User tidak boleh melaporkan produk miliknya sendiri
        if ($product->user_id === $user->id) {
            return response()->json([
                'message' => 'Anda tidak dapat melaporkan produk sendiri.',
            ], 403);
        }

        $report = Report::create([
            'reporter_id' => $user->id,
            'product_id' => $product->id,
            'reason' => $validated['reason'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending',
        ]);

        $report->load([
            'reporter',
            'product',
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dibuat',
            'report' => $report,
        ], 201);
    }

        public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat melihat semua laporan.',
            ], 403);
        }

        $reports = Report::with([
            'reporter',
            'product',
        ])
        ->latest()
        ->get();

        return response()->json([
            'reports' => $reports,
        ]);
    }

        public function updateStatus(Request $request, Report $report)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'Hanya admin yang dapat memproses laporan.',
            ], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,rejected',
        ]);

        $report->update([
            'status' => $validated['status'],
        ]);

        $report->load([
            'reporter',
            'product',
        ]);

        return response()->json([
            'message' => 'Status laporan berhasil diperbarui',
            'report' => $report,
        ]);
    }
}