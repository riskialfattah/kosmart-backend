<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportWebController extends Controller
{
    public function index()
    {
        // Mengambil semua laporan beserta data pelapor (user) dan produknya
        $reports = Report::with(['user', 'product'])->latest()->get();
        
        return view('admin.reports', compact('reports'));
    }

    public function show(Report $report)
    {
        // Memuat data pelapor dan data produk (beserta pemilik produknya)
        $report->load(['user', 'product.user']);
        return view('admin.report-detail', compact('report'));
    }

    // Memproses/mengubah status laporan
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,resolved,rejected'
        ]);

        $report->update([
            'status' => $request->status
        ]);

        return redirect('/admin/reports')->with('success', 'Status laporan berhasil diperbarui.');
    }
}
