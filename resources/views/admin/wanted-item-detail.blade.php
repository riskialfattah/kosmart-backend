<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Barang Dicari - KosMart</title>
    <style>
        /* CSS dasar disamakan dengan tema KosMart */
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
        
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; padding: 30px; max-width: 600px; }
        .detail-row { margin-bottom: 15px; display: flex; border-bottom: 1px solid #252932; padding-bottom: 10px; }
        .detail-label { width: 160px; color: #9ca3af; font-size: 14px; flex-shrink: 0; }
        .detail-value { font-size: 15px; color: #e5e7eb; }
        
        .badge { padding: 5px 9px; border-radius: 20px; font-size: 11px; display: inline-block; }
        .badge-active { background: #1e3a8a; color: #93c5fd; }
        .badge-fulfilled { background: #14532d; color: #86efac; }
        .badge-closed { background: #7f1d1d; color: #fca5a5; }
        .badge-condition { background: #374151; color: #d1d5db; }
        
        .action-buttons { margin-top: 30px; display: flex; gap: 10px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; font-weight: bold; }
        .btn-back { background: #374151; color: white; }
        .btn-delete { background: transparent; border: 1px solid #7f1d1d; color: #f87171; }
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
            <a href="/admin/wanted-items" class="active">🔎 Barang Dicari</a>
            <a href="/admin/reports">⚠️ Laporan</a>
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Detail Barang Dicari</h2>
            <p class="description">Informasi detail mengenai barang yang sedang dicari mahasiswa.</p>
        </div>

        <div class="panel">
            <div class="detail-row">
                <div class="detail-label">ID Posting</div>
                <div class="detail-value">#{{ $wantedItem->id }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Pencari</div>
                <div class="detail-value">{{ $wantedItem->user->name ?? 'Tidak diketahui' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Judul (Barang)</div>
                <div class="detail-value" style="font-weight: bold;">{{ $wantedItem->title }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Budget</div>
                <div class="detail-value" style="color: #4ade80;">Rp{{ number_format($wantedItem->budget, 0, ',', '.') }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Kondisi Harapan</div>
                <div class="detail-value">
                    <span class="badge badge-condition">{{ str_replace('_', ' ', ucfirst($wantedItem->condition)) }}</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Lokasi</div>
                <div class="detail-value">{{ $wantedItem->location }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value">
                    @if($wantedItem->status == 'active')
                        <span class="badge badge-active">Aktif</span>
                    @elseif($wantedItem->status == 'fulfilled')
                        <span class="badge badge-fulfilled">Terpenuhi</span>
                    @else
                        <span class="badge badge-closed">Ditutup</span>
                    @endif
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Deskripsi Tambahan</div>
                <div class="detail-value">{{ $wantedItem->description ?? '-' }}</div>
            </div>

            <div class="action-buttons">
                <a href="/admin/wanted-items" class="btn btn-back">← Kembali</a>
                <form action="/admin/wanted-items/{{ $wantedItem->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus postingan ini?')">🗑️ Hapus Posting</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>