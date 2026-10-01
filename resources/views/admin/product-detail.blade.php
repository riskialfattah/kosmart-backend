<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - KosMart</title>
    <style>
        /* CSS yang konsisten dengan tema KosMart */
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
        .panel { background: #181b21; border: 1px solid #2b3038; border-radius: 12px; padding: 30px; max-width: 700px; }
        
        .detail-row { margin-bottom: 15px; display: flex; border-bottom: 1px solid #252932; padding-bottom: 10px; }
        .detail-label { width: 150px; color: #9ca3af; font-size: 14px; flex-shrink: 0; }
        .detail-value { font-size: 15px; color: #e5e7eb; line-height: 1.5; }
        
        .badge { padding: 5px 9px; border-radius: 20px; font-size: 11px; display: inline-block; }
        .badge-available { background: #14532d; color: #86efac; }
        .badge-sold { background: #7f1d1d; color: #fca5a5; }
        .badge-condition { background: #1e3a8a; color: #93c5fd; }
        
        .action-buttons { margin-top: 30px; display: flex; gap: 10px; }
        .btn { padding: 10px 20px; border-radius: 8px; text-decoration: none; font-size: 14px; cursor: pointer; border: none; }
        .btn-back { background: #374151; color: white; }
        .btn-back:hover { background: #4b5563; }
        .btn-delete { background: transparent; border: 1px solid #7f1d1d; color: #f87171; }
        .btn-delete:hover { background: #7f1d1d; color: white; }
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
            <a href="/admin/products" class="active">📦 Produk</a>
            <a href="/admin/categories">🏷️ Kategori</a>
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
            <h2>Detail Produk</h2>
            <p class="description">Informasi lengkap barang yang diposting.</p>
        </div>

        <div class="panel">
            <div class="detail-row">
                <div class="detail-label">ID Produk</div>
                <div class="detail-value">#{{ $product->id }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Nama Produk</div>
                <div class="detail-value" style="font-weight: bold; font-size: 18px;">{{ $product->name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Pemilik</div>
                <div class="detail-value">{{ $product->user->name ?? 'Tidak diketahui' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Kategori</div>
                <div class="detail-value">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Kondisi</div>
                <div class="detail-value">
                    <span class="badge badge-condition">
                        @php
                            $kondisi = match($product->condition) {
                                'baru'        => '✨ BNWT / BNIB',
                                'bekas_baik'  => '🌟 Like New / Good Cond',
                                'bekas_layak' => '👌 Fair / Minus',
                                default       => $product->condition
                            };
                        @endphp
                        {{ $kondisi }}
                    </span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Harga</div>
                <div class="detail-value" style="color: #4ade80;">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status</div>
                <div class="detail-value">
                    @if($product->status == 'available')
                        <span class="badge badge-available">Tersedia</span>
                    @else
                        <span class="badge badge-sold">Terjual</span>
                    @endif
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Lokasi COD</div>
                <div class="detail-value">{{ $product->location }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Deskripsi</div>
                <div class="detail-value">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Posting</div>
                <div class="detail-value">{{ $product->created_at->format('d M Y H:i') }}</div>
            </div>

            <div class="action-buttons">
                <a href="/admin/products" class="btn btn-back">← Kembali</a>
                
                <!-- Tombol Hapus Produk (Sesuai Use Case Admin UC-27) -->
                <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini secara permanen?')">🗑️ Hapus Produk</button>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>