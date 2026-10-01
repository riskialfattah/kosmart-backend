<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengguna - KosMart</title>

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

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;
            padding: 11px;
            border: 1px solid #7f1d1d;
            border-radius: 8px;
            background: transparent;
            color: #f87171;
            cursor: pointer;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            margin-bottom: 30px;
        }

        .topbar h2 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .description {
            color: #9ca3af;
        }

        .panel {
            background: #181b21;
            border: 1px solid #2b3038;
            border-radius: 12px;
            overflow: hidden;
        }

        .panel-header {
            padding: 20px;
            border-bottom: 1px solid #2b3038;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #252932;
        }

        th {
            color: #9ca3af;
            font-size: 12px;
        }

        td {
            font-size: 14px;
        }

        .badge {
            padding: 5px 9px;
            border-radius: 20px;
            background: #172554;
            color: #93c5fd;
            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            <h1>KOSMART</h1>
            <p>ADMIN PANEL</p>
        </div>

        <div class="menu-title">
            Menu
        </div>

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

        <div class="logout">

            <form method="POST" action="/admin/logout">

                @csrf

                <button type="submit">
                    🚪 Logout
                </button>

            </form>

        </div>

    </aside>


    <!-- CONTENT -->

    <main class="content">

        <div class="topbar">

            <h2>Pengguna</h2>

            <p class="description">
                Daftar mahasiswa yang menggunakan KosMart.
            </p>

        </div>


        <div class="panel">

            <div class="panel-header">

                <h3>
                    Daftar Pengguna
                </h3>

            </div>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Lokasi</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

 @forelse ($users as $user)

                    <tr>

                        <td>
                            {{ $user->id }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ $user->phone ?? '-' }}
                        </td>

                        <td>
                            {{ $user->location ?? '-' }}
                        </td>

                        <!-- Ini kolom Role yang sebelumnya terlewat -->
                        <td>
                            <span class="badge">{{ $user->role }}</span>
                        </td>

                        <!-- Ini kolom Aksi untuk link Detail -->
                        <td>
                            <a
                                href="/admin/users/{{ $user->id }}"
                                style="
                                    color: #ff3b30;
                                    text-decoration: none;
                                    font-weight: bold;
                                "
                            >
                            Detail
                            </a>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <!-- Colspan disesuaikan dengan total 7 kolom -->
                        <td colspan="7">
                            Belum ada pengguna.
                        </td>

                    </tr>

                @endforelse

                </tbody>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>