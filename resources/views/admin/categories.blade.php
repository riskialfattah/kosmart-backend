<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - KosMart</title>
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
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .topbar-text h2 { font-size: 25px; margin-bottom: 8px; }
        .description { color: #9ca3af; }
        
        .btn-add { background: #ff3b30; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: bold; border: none; cursor: pointer; }
        .btn-add:hover { background: #dc2626; }
        
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; overflow: hidden; }
        .panel-header { padding: 20px; border-bottom: 1px solid #2b3038; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #252932; }
        th { color: #9ca3af; font-size: 12px; }
        td { font-size: 14px; }
        
        .badge-count { background: #374151; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px; }
        .action-link { color: #ff3b30; text-decoration: none; font-weight: bold; margin-right: 15px; }
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
            <a href="/admin/categories" class="active">🏷️ Kategori</a>
            <a href="/admin/wanted-items">🔎 Barang Dicari</a>
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
            <div class="topbar-text">
                <h2>Kategori</h2>
                <p class="description">Kelola kategori barang preloved.</p>
            </div>
            <!-- Tombol Tambah Kategori (Belum aktif, disiapkan untuk tahap berikutnya) -->
            <a href="/admin/categories/create" class="btn-add">+ Tambah Kategori</a>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3>Daftar Kategori</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 50%;">Nama Kategori</th>
                        <th style="width: 20%;">Total Produk</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td style="font-weight: bold;">{{ $category->name }}</td>
                        <td>
                            <span class="badge-count">{{ $category->products_count }} Produk</span>
                        </td>
                        <td>
                            <a href="/admin/categories/{{ $category->id }}/edit" class="action-link" style="color: #3b82f6;">Edit</a>
                            
                            <form action="/admin/categories/{{ $category->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-link" style="background:none; border:none; cursor:pointer;" onclick="return confirm('Yakin ingin menghapus kategori ini? Pastikan tidak ada produk di kategori ini.')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #9ca3af;">Belum ada kategori.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>