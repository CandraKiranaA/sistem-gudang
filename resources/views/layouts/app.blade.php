<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Sistem Gudang')
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background-color: #f5f6fa;
        }

        /* ==============================
           SIDEBAR
        ============================== */

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
        }

        .sidebar-content {
            flex: 1;
        }

        .sidebar .brand {
            font-size: 20px;
            font-weight: 700;
            padding: 22px 20px;
            color: #111827;
        }

        /* ==============================
           SECTION
        ============================== */

        .sidebar-heading {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #9ca3af;
            font-weight: 700;
            padding: 18px 20px 7px 20px;
        }

        /* ==============================
           MENU
        ============================== */

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            margin: 3px 12px;
            font-size: 0.925rem;
            transition: all 0.2s ease-in-out;
        }

        .sidebar a:hover {
            background-color: #f3f4ff;
            color: #4f46e5;
        }

        .sidebar a.active {
            background-color: #eef2ff;
            color: #4f46e5;
            font-weight: 600;
        }

        /* ==============================
           USER
        ============================== */

        .user-area {
            border-top: 1px solid #e5e7eb;
            padding: 16px 12px;
        }

        .user-info {
            padding: 8px;
        }

        /* ==============================
           LOGOUT
        ============================== */

        .logout-btn {
            border-radius: 8px;
        }

        /* ==============================
           CONTENT
        ============================== */

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


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <div class="col-md-2 sidebar p-0">


            {{-- =================================================
                 BAGIAN MENU
            ================================================== --}}

            <div class="sidebar-content">


                {{-- BRAND --}}

                <div class="brand">
                    📦 Sistem Gudang
                </div>


                {{-- =================================================
                     DASHBOARD
                ================================================== --}}

                <a
                    href="/dashboard"
                    class="{{ request()->is('dashboard') ? 'active' : '' }}"
                >
                    🏠 Dashboard
                </a>


                {{-- =================================================
                     MASTER DATA
                ================================================== --}}

                <div class="sidebar-heading">
                    Master Data
                </div>


                <a
                    href="{{ route('barangs.index') }}"
                    class="{{ request()->routeIs('barangs.*') ? 'active' : '' }}"
                >
                    📦 Data Barang
                </a>


                {{-- =================================================
                     TRANSAKSI
                ================================================== --}}

                <div class="sidebar-heading">
                    Transaksi
                </div>


                {{-- STOCK IN --}}

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}"
                >
                    📥 Stock In
                </a>


                {{-- BUAT NOTA --}}

                <a
                    href="#"
                    class="{{ request()->is('nota*') ? 'active' : '' }}"
                >
                    🧾 Buat Nota
                </a>


                {{-- STOCK OUT --}}

                <a
                    href="#"
                    class="{{ request()->is('stock-out*') ? 'active' : '' }}"
                >
                    📤 Stock Out
                </a>


                {{-- =================================================
                     LAPORAN
                ================================================== --}}

                <div class="sidebar-heading">
                    Laporan
                </div>


                {{-- LAPORAN BARANG KELUAR --}}

                <a
                    href="#"
                    class="{{ request()->is('laporan/barang-keluar*') ? 'active' : '' }}"
                >
                    📊 Barang Keluar
                </a>


                {{-- LAPORAN CUSTOMER --}}

                <a
                    href="#"
                    class="{{ request()->is('laporan/customer*') ? 'active' : '' }}"
                >
                    👥 Customer
                </a>


            </div>


            {{-- =====================================================
                 USER AREA
            ====================================================== --}}

            <div class="user-area">


                {{-- USER INFO --}}

                <div class="user-info d-flex align-items-center mb-2">

                    <div class="me-2 fs-5">
                        👤
                    </div>

                    <div>

                        <div class="fw-semibold">
                            {{ Auth::user()?->name ?? 'Admin Gudang' }}
                        </div>

                        <small class="text-muted">
                            Admin Gudang
                        </small>

                    </div>

                </div>


                {{-- GANTI PASSWORD --}}

                <a
                    href="/change-password"
                    class="m-0 mb-2"
                >
                    🔑 Ganti Password
                </a>


                {{-- LOGOUT --}}

                @auth

                    <form
                        action="/logout"
                        method="POST"
                        class="px-0"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger w-100 logout-btn"
                        >
                            🚪 Logout
                        </button>

                    </form>

                @endauth


            </div>


        </div>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="col-md-10">

            <div class="content">

                @yield('content')

            </div>

        </div>


    </div>

</div>


{{-- Bootstrap JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>