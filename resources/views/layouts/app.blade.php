<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Gudang')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: bold;
            padding: 20px;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            font-weight: 700;
            padding: 14px 20px 4px 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            margin: 2px 12px;
            font-size: 0.925rem;
            transition: all 0.2s ease-in-out;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-2 sidebar p-0 pb-3">

                <div>
                    <!-- BRAND -->
                    <div class="brand">
                        📦 Sistem Gudang
                    </div>

                    <!-- MENU UTAMA -->
                    <a href="#" class="active">
                        🏠 Dashboard
                    </a>

                    <!-- MASTER DATA -->
                    <div class="sidebar-heading">Master Data</div>
                    <a href="#">
                        📦 Data Barang
                    </a>
                    <a href="#">
                        👥 Data Customer
                    </a>

                    <!-- TRANSAKSI & STOK -->
                    <div class="sidebar-heading">Transaksi & Stok</div>
                    <a href="#">
                        📥 Stok Masuk (Stock In)
                    </a>
                    <a href="#">
                        🧾 Pembelian & Nota (Stock Out)
                    </a>

                    <!-- LAPORAN -->
                    <div class="sidebar-heading">Laporan</div>
                    <a href="#">
                        📊 Laporan Stok Gudang
                    </a>
                    <a href="#">
                        📋 Laporan Barang Keluar
                    </a>
                </div>

                <!-- USER PROFILE & LOGOUT -->
                <div>
                    <hr class="mx-3">
                    <div class="px-3 mb-2">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-2 fs-5">👤</div>
                            <div>
                                <div class="fw-semibold text-truncate" style="max-width: 120px;">
                                    Admin Gudang
                                </div>
                                <small class="text-muted">Administrator</small>
                            </div>
                        </div>

                        <a href="#" class="p-0 text-muted small text-decoration-none">
                            🔑 Ganti Password
                        </a>
                    </div>

                    <form action="#" method="POST" class="px-3 mt-2">
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            🚪 Logout
                        </button>
                    </form>
                </div>

            </div>


            <!-- CONTENT -->
            <div class="col-md-10">

                <div class="content">

                    @yield('content')

                </div>

            </div>

        </div>
    </div>

</body>

</html>