<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sistem Gudang')
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            background-color: #f5f6fa;
            color: #1f2937;
        }


        /* =========================================================
           LAYOUT
        ========================================================= */

        .app-wrapper {
            min-height: 100vh;
            display: flex;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            width: 245px;
            min-width: 245px;
            min-height: 100vh;

            background-color: #ffffff;

            border-right: 1px solid #e5e7eb;

            display: flex;
            flex-direction: column;

            position: sticky;
            top: 0;

            height: 100vh;
        }


        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;

            padding-bottom: 15px;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .sidebar .brand {

            display: flex;
            align-items: center;

            min-height: 70px;

            padding: 18px 20px;

            color: #111827;

            font-size: 19px;
            font-weight: 700;

            white-space: nowrap;

            overflow: visible;

            letter-spacing: -0.2px;
        }


        .brand-icon {
            margin-right: 8px;
            flex-shrink: 0;
        }


        .brand-text {
            white-space: nowrap;
        }


        /* =========================================================
           SECTION HEADING
        ========================================================= */

        .sidebar-heading {

            font-size: 0.70rem;

            text-transform: uppercase;

            letter-spacing: 0.09em;

            color: #9ca3af;

            font-weight: 700;

            padding: 18px 20px 7px 20px;
        }


        /* =========================================================
           MENU
        ========================================================= */

        .sidebar-menu {

            padding: 0 10px;
        }


        .sidebar a.menu-link {

            display: flex;

            align-items: center;

            width: 100%;

            min-height: 42px;

            padding: 9px 12px;

            margin: 3px 0;

            color: #4b5563;

            background-color: transparent;

            text-decoration: none;

            border-radius: 8px;

            font-size: 0.925rem;

            font-weight: 500;

            transition:
                color 0.2s ease,
                background-color 0.2s ease,
                transform 0.15s ease;
        }


        /* =========================================================
           ICON MENU
        ========================================================= */

        .menu-icon {

            width: 28px;

            min-width: 28px;

            margin-right: 5px;

            text-align: center;

            font-size: 17px;

            line-height: 1;
        }


        .menu-text {

            white-space: nowrap;
        }


        /* =========================================================
           HOVER
        ========================================================= */

        .sidebar a.menu-link:hover {

            background-color: #fffbea;

            color: #d4a700;

            transform: translateX(2px);
        }


        /* =========================================================
           ACTIVE
           HANYA TEXT YANG KUNING
        ========================================================= */

        .sidebar a.menu-link.active {

            background-color: transparent;

            color: #d4a700;

            font-weight: 700;
        }


        .sidebar a.menu-link.active:hover {

            background-color: #fffbea;

            color: #d4a700;
        }


        /* =========================================================
           USER AREA
        ========================================================= */

        .user-area {

            flex-shrink: 0;

            border-top: 1px solid #e5e7eb;

            padding: 15px 12px;

            background-color: #ffffff;
        }


        .user-info {

            padding: 8px;

            min-width: 0;
        }


        .user-icon {

            width: 32px;

            min-width: 32px;

            height: 32px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background-color: #f3f4f6;
        }


        .user-name {

            max-width: 150px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =========================================================
           PASSWORD LINK
        ========================================================= */

        .password-link {

            display: flex !important;

            align-items: center;

            margin: 0 0 8px 0 !important;

            padding: 9px 10px !important;

            color: #4b5563 !important;
        }


        .password-link:hover {

            color: #d4a700 !important;

            background-color: #fffbea !important;
        }


        /* =========================================================
           LOGOUT
        ========================================================= */

        .logout-form {

            padding: 0 4px;
        }


        .logout-btn {

            height: 40px;

            border-radius: 8px;

            font-size: 14px;

            font-weight: 500;
        }


        /* =========================================================
           MAIN CONTENT
        ========================================================= */

        .main-content {

            flex: 1;

            min-width: 0;

            background-color: #f5f6fa;
        }


        .content {

            width: 100%;

            padding: 30px;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .card {

            border: none;

            border-radius: 12px;
        }


        /* =========================================================
           TABLE SUPAYA TIDAK MERUSAK LAYOUT
        ========================================================= */

        .table-responsive {

            width: 100%;

            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        /* =========================================================
           SCROLLBAR SIDEBAR
        ========================================================= */

        .sidebar-content::-webkit-scrollbar {

            width: 5px;
        }


        .sidebar-content::-webkit-scrollbar-track {

            background: transparent;
        }


        .sidebar-content::-webkit-scrollbar-thumb {

            background: #d1d5db;

            border-radius: 10px;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 991px) {

            .sidebar {

                width: 220px;

                min-width: 220px;
            }

            .sidebar .brand {

                font-size: 18px;

                padding-left: 16px;

                padding-right: 16px;
            }

            .content {

                padding: 22px;
            }
        }


        @media (max-width: 767px) {

            .app-wrapper {

                display: block;
            }


            .sidebar {

                width: 100%;

                min-width: 100%;

                min-height: auto;

                height: auto;

                position: relative;

                display: block;
            }


            .sidebar-content {

                overflow: visible;
            }


            .sidebar .brand {

                min-height: 60px;

                font-size: 18px;
            }


            .user-area {

                display: none;
            }


            .main-content {

                width: 100%;
            }


            .content {

                padding: 15px;
            }

        }

    </style>

</head>


<body>

<div class="app-wrapper">


    {{-- =========================================================
         SIDEBAR
    ========================================================= --}}

    <aside class="sidebar">


        {{-- =====================================================
             MENU CONTENT
        ====================================================== --}}

        <div class="sidebar-content">


            {{-- =================================================
                 BRAND
            ================================================== --}}

            <div class="brand">

                <span class="brand-icon">
                    📦
                </span>

                <span class="brand-text">
                    Sistem Gudang
                </span>

            </div>



            {{-- =================================================
                 DASHBOARD
            ================================================== --}}

            <div class="sidebar-menu">

                <a
                    href="{{ route('dashboard') }}"
                    class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        🏠
                    </span>

                    <span class="menu-text">
                        Dashboard
                    </span>

                </a>

            </div>



            {{-- =================================================
                 MASTER DATA
            ================================================== --}}

            <div class="sidebar-heading">
                Master Data
            </div>


            <div class="sidebar-menu">

                {{-- DATA BARANG --}}

                <a
                    href="{{ route('barangs.index') }}"
                    class="menu-link {{ request()->routeIs('barangs.*') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        📦
                    </span>

                    <span class="menu-text">
                        Data Barang
                    </span>

                </a>

            </div>



            {{-- =================================================
                 TRANSAKSI
            ================================================== --}}

            <div class="sidebar-heading">
                Transaksi
            </div>


            <div class="sidebar-menu">


                {{-- STOCK IN --}}

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="menu-link {{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        📥
                    </span>

                    <span class="menu-text">
                        Stock In
                    </span>

                </a>



                {{-- BUAT NOTA --}}

                <a
                    href="{{ route('penjualan.create') }}"
                    class="menu-link {{ request()->routeIs('penjualan.create') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        🧾
                    </span>

                    <span class="menu-text">
                        Buat Nota
                    </span>

                </a>



                {{-- STOCK OUT --}}

                <a
                    href="{{ route('penjualan.index') }}"
                    class="menu-link {{ request()->routeIs('penjualan.index') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        📤
                    </span>

                    <span class="menu-text">
                        Stock Out
                    </span>

                </a>

            </div>



            {{-- =================================================
                 LAPORAN
            ================================================== --}}

            <div class="sidebar-heading">
                Laporan
            </div>


            <div class="sidebar-menu">


                {{-- LAPORAN BARANG --}}

                <a
                    href="{{ route('laporan.barang.index') }}"
                    class="menu-link {{ request()->routeIs('laporan.barang.*') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        📊
                    </span>

                    <span class="menu-text">
                        Barang Keluar
                    </span>

                </a>



                {{-- CUSTOMER --}}

                <a
                    href="{{ route('customers.index') }}"
                    class="menu-link {{ request()->routeIs('customers.*') ? 'active' : '' }}"
                >

                    <span class="menu-icon">
                        👥
                    </span>

                    <span class="menu-text">
                        Customer
                    </span>

                </a>

            </div>


        </div>



        {{-- =====================================================
             USER AREA
        ====================================================== --}}

        <div class="user-area">


            {{-- =================================================
                 USER INFO
            ================================================== --}}

            @auth

                <div class="user-info d-flex align-items-center mb-2">

                    <div class="user-icon me-2">
                        👤
                    </div>


                    <div class="min-width-0">

                        <div class="fw-semibold user-name">

                            {{ Auth::user()?->name ?? 'Admin Gudang' }}

                        </div>

                        <small class="text-muted">
                            Admin Gudang
                        </small>

                    </div>

                </div>

            @endauth



            {{-- =================================================
                 GANTI PASSWORD
            ================================================== --}}

            <a
                href="{{ route('change-password') }}"
                class="menu-link password-link {{ request()->routeIs('change-password*') ? 'active' : '' }}"
            >

                <span class="menu-icon">
                    🔑
                </span>

                <span class="menu-text">
                    Ganti Password
                </span>

            </a>



            {{-- =================================================
                 LOGOUT
            ================================================== --}}

            @auth

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
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


    </aside>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================= --}}

    <main class="main-content">

        <div class="content">

            @yield('content')

        </div>

    </main>


</div>



{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>