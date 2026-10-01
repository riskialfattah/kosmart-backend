<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Dicari - KosMart</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #0f1115; color: white; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #181b21; border-right: 1px solid #2b3038; padding: 25px 15px; }
        .logo { text-align: center; margin-bottom: 35px; }
        .logo h1 { color: #ff3b30; letter-spacing: 2px; }
        .logo p { color: #777; font-size: 12px; margin-top: 5px; }
        .menu-title { color: #666; font-size: 11px; text-transform: uppercase; margin: 20px 10px 10px; }
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
        
        .badge { padding: 5px 9px; border-radius: 20px; font-size: 11px; }
        .badge-active { background: #1e3a8a; color: #93c5fd; }
        .badge-fulfilled { background: #14532d; color: #86efac; }
        .badge-closed { background: #7f1d1d; color: #fca5a5; }
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
        <div class="menu-title">Menu</div>
        <nav class="menu">
            <a href="/admin/dashboard">🏠 Dashboard</a>
            <a href="/admin/users">👥 Pengguna</a>
            <a href="/admin/products">📦 Produk</a>
            <a href="/admin/categories">🏷️ Kategori</a>
            <a href="/admin/wanted-items" class="active">🔎 Barang Dicari</a>
            <a href="/admin/reports">⚠️ Laporan</a>
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
            <h2>Barang Dicari</h2>
            <p class="description">Daftar postingan mahasiswa yang sedang mencari barang.</p>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3>Daftar Posting "Dicari"</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pencari</th>
                        <th>Barang yang Dicari</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($wantedItems as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                        <td style="font-weight: bold;">{{ $item->title }}</td>
                        <td>Rp{{ number_format($item->budget, 0, ',', '.') }}</td>
                        <td>
                            @if($item->status == 'active')
                                <span class="badge badge-active">Aktif</span>
                            @elseif($item->status == 'fulfilled')
                                <span class="badge badge-fulfilled">Terpenuhi</span>
                            @else
                                <span class="badge badge-closed">Ditutup</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/wanted-items/{{ $item->id }}" class="action-link">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #9ca3af;">Belum ada postingan barang dicari.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>