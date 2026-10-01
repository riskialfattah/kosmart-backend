<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pengguna - KosMart</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #0f1115;
            color: white;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #181b21;
            border-right: 1px solid #2b3038;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo h1 {
            color: #ff3b30;
            letter-spacing: 2px;
        }

        .logo p {
            color: #777;
            font-size: 12px;
            margin-top: 5px;
        }

        .menu-title {
            color: #666;
            font-size: 11px;
            text-transform: uppercase;
            margin: 20px 10px 10px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #c9cdd4;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #2b1a1a;
            color: #ff3b30;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            margin-bottom: 25px;
        }

        .topbar h2 {
            margin-bottom: 8px;
        }

        .description {
            color: #9ca3af;
        }

        .panel {
            max-width: 900px;
            background: #181b21;
            border: 1px solid #2b3038;
            border-radius: 12px;
            overflow: hidden;
        }

        .panel-title {
            padding: 22px 25px;
            border-bottom: 1px solid #2b3038;
            font-size: 20px;
            font-weight: bold;
        }

        .detail {
            display: grid;
            grid-template-columns: 220px 1fr;
            border-bottom: 1px solid #2b3038;
        }

        .detail:last-child {
            border-bottom: none;
        }

        .label {
            padding: 18px 25px;
            color: #9ca3af;
            font-weight: bold;
        }

        .value {
            padding: 18px 25px;
            color: white;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #172d68;
            color: #5b8cff;
            font-size: 13px;
        }

        .actions {
            margin-top: 25px;
        }

        .back {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 8px;
            background: #2b3038;
            color: white;
            text-decoration: none;
        }

        .back:hover {
            background: #343a45;
        }

        @media (max-width: 700px) {

            .sidebar {
                width: 200px;
            }

            .detail {
                grid-template-columns: 1fr;
            }

            .label {
                padding-bottom: 5px;
            }

            .value {
                padding-top: 5px;
            }
        }
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

            <a href="/admin/dashboard">
                🏠 Dashboard
            </a>

            <a href="/admin/users" class="active">
                👥 Pengguna
            </a>

            <a href="/admin/products">
                📦 Produk
            </a>

            <a href="/admin/categories">
                🏷️ Kategori
            </a>

            <a href="/admin/wanted-items">
                🔎 Barang Dicari
            </a>

            <a href="/admin/reports">
                ⚠️ Laporan
            </a>

        </nav>

    </aside>

    <main class="content">

        <div class="topbar">

            <h2>Detail Pengguna</h2>

            <p class="description">
                Informasi pengguna yang terdaftar di KosMart.
            </p>

        </div>

        <div class="panel">

            <div class="panel-title">
                Informasi Pengguna
            </div>

            <div class="detail">
                <div class="label">ID</div>
                <div class="value">{{ $user->id }}</div>
            </div>

            <div class="detail">
                <div class="label">Nama</div>
                <div class="value">{{ $user->name }}</div>
            </div>

            <div class="detail">
                <div class="label">Email</div>
                <div class="value">{{ $user->email }}</div>
            </div>

            <div class="detail">
                <div class="label">No. Telepon</div>
                <div class="value">{{ $user->phone ?? '-' }}</div>
            </div>

            <div class="detail">
                <div class="label">Lokasi</div>
                <div class="value">{{ $user->location ?? '-' }}</div>
            </div>

            <div class="detail">
                <div class="label">Role</div>
                <div class="value">
                    <span class="badge">
                        {{ $user->role }}
                    </span>
                </div>
            </div>

        </div>

        <div class="actions">

            <a href="/admin/users" class="back">
                ← Kembali ke Daftar Pengguna
            </a>

        </div>

    </main>

</div>

</body>
</html>