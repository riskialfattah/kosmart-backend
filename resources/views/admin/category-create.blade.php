<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori - KosMart</title>
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
        
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; padding: 30px; max-width: 500px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #9ca3af; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 15px; border-radius: 8px; background: #0f1115; border: 1px solid #2b3038; color: white; font-size: 14px; }
        .form-control:focus { outline: none; border-color: #ff3b30; }
        
        .action-buttons { display: flex; gap: 10px; margin-top: 20px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; font-weight: bold; }
        .btn-save { background: #ff3b30; color: white; }
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
            <a href="/admin/categories" class="active">🏷️ Kategori</a>
        </nav>
    </aside>

    <main class="content">
        <div class="topbar">
            <h2>Tambah Kategori</h2>
            <p class="description">Buat kategori baru untuk pengelompokan barang.</p>
        </div>

        <div class="panel">
            <form action="/admin/categories" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Alat Tulis" required>
                </div>
                <div class="action-buttons">
                    <button type="submit" class="btn btn-save">💾 Simpan Kategori</button>
                    <a href="/admin/categories" class="btn btn-back">Batal</a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>