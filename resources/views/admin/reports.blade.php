<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - KosMart</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #0f1115; color: white; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #181b21; border-right: 1px solid #2b3038; padding: 25px 15px; }
        .logo { text-align: center; margin-bottom: 35px; }
        .logo h1 { color: #ff3b30; letter-spacing: 2px; }
        .logo p { color: #777; font-size: 12px; margin-top: 5px; }
        .menu a { display: block; text-decoration: none; color: #c9cdd4; padding: 12px 15px; border-radius: 8px; margin-bottom: 5px; font-size: 14px; }
        .menu a:hover, .menu a.active { background: #2b1a1a; color: #ff3b30; }
        .logout { margin-top: 30px; }
        .logout button { width: 100%; padding: 11px; border: 1px solid #7f1d1d; border-radius: 8px; background: transparent; color: #f87171; cursor: pointer; }
        
        .content { flex: 1; padding: 30px; }
        .topbar { margin-bottom: 30px; }
        .topbar h2 { font-size: 25px; margin-bottom: 8px; }
        .description { color: #9ca3af; }
        
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; overflow: hidden; }
        .panel-header { padding: 20px; border-bottom: 1px solid #2b3038; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #252932; }
        th { color: #9ca3af; font-size: 12px; }
        td { font-size: 14px; }
        
        .badge { padding: 5px 9px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .badge-pending { background: #78350f; color: #fde68a; }
        .badge-reviewed { background: #1e3a8a; color: #93c5fd; }
        .badge-resolved { background: #14532d; color: #86efac; }
        .badge-rejected { background: #7f1d1d; color: #fca5a5; }
        .action-link { color: #ff3b30; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="logo">
            <h1>KOSMART</h1>
            <p>ADMIN PANEL</p>
        </div>
        <nav class="menu">
            <a href="/admin/dashboard">🏠 Dashboard</a>
            <a href="/admin/users">👥 Pengguna</a>
            <a href="/admin/products">📦 Produk</a>
            <a href="/admin/categories">🏷️ Kategori</a>
            <a href="/admin/wanted-items">🔎 Barang Dicari</a>
            <a href="/admin/reports" class="active">⚠️ Laporan</a>
        </nav>
        <div class="logout">
            <form method="POST" action="/admin/logout">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Laporan Pengguna</h2>
            <p class="description">Daftar laporan terkait produk yang melanggar aturan KosMart.</p>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3>Daftar Laporan</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelapor</th>
                        <th>Produk (ID)</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->user->name ?? 'Tidak diketahui' }}</td>
                        <td>
                            <a href="/admin/products/{{ $report->product_id }}" style="color: #60a5fa; text-decoration: none;">
                                {{ $report->product->name ?? 'Produk #'.$report->product_id }}
                            </a>
                        </td>
                        <td>{{ Str::limit($report->reason, 40) }}</td>
                        <td>
                            @if($report->status == 'pending')
                                <span class="badge badge-pending">Menunggu</span>
                            @elseif($report->status == 'reviewed')
                                <span class="badge badge-reviewed">Ditinjau</span>
                            @elseif($report->status == 'resolved')
                                <span class="badge badge-resolved">Diselesaikan</span>
                            @else
                                <span class="badge badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/reports/{{ $report->id }}" class="action-link">Detail & Proses</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #9ca3af;">Belum ada laporan dari pengguna.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>