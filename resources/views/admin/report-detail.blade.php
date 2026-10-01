<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan - KosMart</title>
    <style>
        /* CSS dasar KosMart */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #0f1115; color: white; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #181b21; border-right: 1px solid #2b3038; padding: 25px 15px; }
        .logo { text-align: center; margin-bottom: 35px; }
        .logo h1 { color: #ff3b30; letter-spacing: 2px; }
        .logo p { color: #777; font-size: 12px; margin-top: 5px; }
        .menu a { display: block; text-decoration: none; color: #c9cdd4; padding: 12px 15px; border-radius: 8px; margin-bottom: 5px; font-size: 14px; }
        .menu a.active { background: #2b1a1a; color: #ff3b30; }
        
        .content { flex: 1; padding: 30px; }
        .topbar h2 { font-size: 25px; margin-bottom: 8px; }
        .description { color: #9ca3af; margin-bottom: 30px; }
        
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; padding: 30px; max-width: 600px; margin-bottom: 20px; }
        .detail-row { margin-bottom: 15px; display: flex; border-bottom: 1px solid #252932; padding-bottom: 10px; }
        .detail-label { width: 150px; color: #9ca3af; font-size: 14px; flex-shrink: 0; }
        .detail-value { font-size: 15px; color: #e5e7eb; line-height: 1.5; }
        
        .badge { padding: 5px 9px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .badge-pending { background: #78350f; color: #fde68a; }
        .badge-reviewed { background: #1e3a8a; color: #93c5fd; }
        .badge-resolved { background: #14532d; color: #86efac; }
        .badge-rejected { background: #7f1d1d; color: #fca5a5; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #9ca3af; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 15px; border-radius: 8px; background: #0f1115; border: 1px solid #2b3038; color: white; font-size: 14px; }
        
        .action-buttons { display: flex; gap: 10px; margin-top: 20px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; font-weight: bold; }
        .btn-save { background: #3b82f6; color: white; }
        .btn-save:hover { background: #2563eb; }
        .btn-back { background: #374151; color: white; }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo"><h1>KOSMART</h1><p>ADMIN PANEL</p></div>
        <nav class="menu">
            <a href="/admin/dashboard">🏠 Dashboard</a>
            <a href="/admin/users">👥 Pengguna</a>
            <a href="/admin/products">📦 Produk</a>
            <a href="/admin/categories">🏷️ Kategori</a>
            <a href="/admin/wanted-items">🔎 Barang Dicari</a>
            <a href="/admin/reports" class="active">⚠️ Laporan</a>
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Detail Laporan</h2>
            <p class="description">Tinjau laporan dan perbarui status penyelesaiannya.</p>
        </div>

        <div class="panel">
            <div class="detail-row">
                <div class="detail-label">ID Laporan</div>
                <div class="detail-value">#{{ $report->id }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Pelapor</div>
                <div class="detail-value">{{ $report->user->name ?? 'Tidak diketahui' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Produk Terkait</div>
                <div class="detail-value">
                    <a href="/admin/products/{{ $report->product_id }}" style="color: #60a5fa; text-decoration: none;">
                        {{ $report->product->name ?? 'Produk #'.$report->product_id }}
                    </a> 
                    <br><span style="font-size: 12px; color: #9ca3af;">(Milik: {{ $report->product->user->name ?? 'Tidak diketahui' }})</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Alasan Laporan</div>
                <div class="detail-value" style="color: #fca5a5;">{{ $report->reason }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Dilaporkan</div>
                <div class="detail-value">{{ $report->created_at->format('d M Y H:i') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status Saat Ini</div>
                <div class="detail-value">
                    @if($report->status == 'pending')
                        <span class="badge badge-pending">Menunggu</span>
                    @elseif($report->status == 'reviewed')
                        <span class="badge badge-reviewed">Ditinjau</span>
                    @elseif($report->status == 'resolved')
                        <span class="badge badge-resolved">Diselesaikan</span>
                    @else
                        <span class="badge badge-rejected">Ditolak</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Update Status Laporan -->
        <div class="panel">
            <form action="/admin/reports/{{ $report->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Proses Status Laporan</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                        <option value="reviewed" {{ $report->status == 'reviewed' ? 'selected' : '' }}>Sedang Ditinjau (Reviewed)</option>
                        <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Diselesaikan (Resolved)</option>
                        <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Ditolak / Laporan Palsu (Rejected)</option>
                    </select>
                </div>
                <div class="action-buttons">
                    <button type="submit" class="btn btn-save">💾 Update Status</button>
                    <a href="/admin/reports" class="btn btn-back">← Kembali</a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>