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
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: bold;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            border-radius: 8px;
            margin: 4px 12px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #eef2ff;
            color: #4f46e5;
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
            <div class="col-md-2 sidebar p-0">

                <div class="brand">
                    📦 Sistem Gudang
                </div>

                <a href="/dashboard">
                    🏠 Dashboard
                </a>

                <a href="#">
                    📦 Data Barang
                </a>

                <a href="#">
                    📥 Barang Masuk
                </a>

                <a href="#">
                    🧾 Buat Nota
                </a>

                <a href="#">
                    📤 Barang Keluar
                </a>

                <hr>

                <div class="px-3 mb-3">

                    <div class="d-flex align-items-center mb-3">

                        <div class="me-2">
                            👤
                        </div>

                        <div>
                            <div class="fw-semibold">
                                {{ Auth::user()->name }}
                            </div>

                            <small class="text-muted">
                                Admin Gudang
                            </small>
                        </div>

                    </div>

                    <a href="/change-password" class="m-0 mb-2">
                        🔑 Ganti Password
                    </a>

                </div>

                <form action="/logout" method="POST" class="px-3">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger w-100">
                        🚪 Logout
                    </button>
                </form>

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