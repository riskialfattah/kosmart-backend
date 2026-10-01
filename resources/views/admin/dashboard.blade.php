<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - KosMart</title>

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

        /* SIDEBAR */

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

        .logout button:hover {
            background: #3a1717;
        }

        /* CONTENT */

        .content {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h2 {
            font-size: 25px;
        }

        .admin-info {
            color: #9ca3af;
            font-size: 14px;
        }

        /* STAT CARDS */

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #181b21;
            border: 1px solid #2b3038;
            border-radius: 12px;
            padding: 22px;
        }

        .card-title {
            color: #9ca3af;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .card-number {
            font-size: 30px;
            font-weight: bold;
        }

        .card-description {
            color: #666;
            font-size: 12px;
            margin-top: 8px;
        }

        /* TABLE */

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

        .panel-header h3 {
            font-size: 17px;
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
            font-size: 11px;
            background: #172554;
            color: #93c5fd;
        }

        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 200px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
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

            <a href="/admin/dashboard" class="active">
                🏠 Dashboard
            </a>

            <a href="/admin/users">
                👥 User
            </a>

            <a href="/admin/products">
                📦 Products
            </a>

            <a href="/admin/categories">
                🏷️ Category
            </a>

            <a href="/admin/wanted-items">
                🔎 Found items
            </a>

            <a href="/admin/reports">
                ⚠️ Report
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

            <div>
                <h2>Dashboard</h2>

                <p class="admin-info">
                    Selamat datang di Admin Panel KosMart
                </p>
            </div>

            <div class="admin-info">
                👤 {{ session('admin_name') }}
            </div>

        </div>


        <!-- STATISTICS -->

        <div class="cards">

            <div class="card">

                <div class="card-title">
                    TOTAL PENGGUNA
                </div>

                <div class="card-number">
                    {{ \App\Models\User::where('role', 'user')->count() }}
                </div>

                <div class="card-description">
                    Pengguna KosMart
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    TOTAL PRODUK
                </div>

                <div class="card-number">
                    {{ \App\Models\Product::count() }}
                </div>

                <div class="card-description">
                    Semua produk
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    KATEGORI
                </div>

                <div class="card-number">
                    {{ \App\Models\Category::count() }}
                </div>

                <div class="card-description">
                    Kategori produk
                </div>

            </div>


            <div class="card">

                <div class="card-title">
                    LAPORAN

                </div>

                <div class="card-number">
                    {{ \App\Models\Report::count() }}
                </div>

                <div class="card-description">
                    Total laporan
                </div>

            </div>

        </div>


        <!-- PRODUCTS -->

        <div class="panel">

            <div class="panel-header">

                <h3>
                    Produk Terbaru
                </h3>

            </div>

            <table>

                <thead>

                    <tr>
                        <th>Produk</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                @foreach (
                    \App\Models\Product::with(['user', 'category'])
                    ->latest()
                    ->take(5)
                    ->get()
                    as $product
                )

                    <tr>

                        <td>
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->user->name ?? '-' }}
                        </td>

                        <td>
                            {{ $product->category->name ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>

                            <span class="badge">
                                {{ $product->status }}
                            </span>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>