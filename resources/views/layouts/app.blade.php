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


    {{-- =========================================================
         BOOTSTRAP
    ========================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        body {

            background-color: #f5f6fa;

            color: #1f2937;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }


        /* =========================================================
           APP WRAPPER
        ========================================================= */

        .app-wrapper {

            min-height: 100vh;

            display: flex;
        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {

            width: 255px;

            min-width: 255px;

            min-height: 100vh;

            height: 100vh;

            background-color: #ffffff;

            border-right: 1px solid #e5e7eb;

            display: flex;

            flex-direction: column;

            position: sticky;

            top: 0;

            box-shadow:
                4px 0 20px rgba(15, 23, 42, 0.025);

            z-index: 1000;
        }


        /* =========================================================
           SIDEBAR CONTENT
        ========================================================= */

        .sidebar-content {

            flex: 1;

            overflow-y: auto;

            overflow-x: hidden;

            padding: 10px 8px 20px;
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .sidebar .brand {

            display: flex;

            align-items: center;

            min-height: 84px;

            margin: 0 2px 18px;

            padding: 13px 14px;

            background:
                linear-gradient(
                    135deg,
                    #fffbea 0%,
                    #fffdf7 55%,
                    #ffffff 100%
                );

            border: 1px solid #f0e4ae;

            border-radius: 16px;

            position: relative;

            overflow: hidden;

            box-shadow:
                0 4px 14px rgba(212, 167, 0, 0.05);
        }


        /* garis aksen */

        .sidebar .brand::before {

            content: "";

            position: absolute;

            left: 0;

            top: 14px;

            bottom: 14px;

            width: 4px;

            background-color: #d4a700;

            border-radius:
                0
                6px
                6px
                0;
        }


        /* efek dekorasi */

        .sidebar .brand::after {

            content: "";

            position: absolute;

            width: 80px;

            height: 80px;

            border-radius: 50%;

            background-color:
                rgba(212, 167, 0, 0.05);

            right: -35px;

            top: -35px;
        }


        /* =========================================================
           BRAND ICON
        ========================================================= */

        .brand-icon-box {

            width: 46px;

            min-width: 46px;

            height: 46px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 12px;

            background-color: #ffffff;

            border: 1px solid #efdf91;

            border-radius: 13px;

            font-size: 23px;

            box-shadow:
                0 5px 12px rgba(31, 41, 55, 0.06);

            position: relative;

            z-index: 2;
        }


        /* =========================================================
           BRAND CONTENT
        ========================================================= */

        .brand-content {

            min-width: 0;

            line-height: 1.15;

            position: relative;

            z-index: 2;
        }


        .brand-text {

            display: block;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

            font-size: 15px;

            font-weight: 800;

            letter-spacing: -0.25px;

            color: #1f2937;
        }


        .brand-subtitle {

            display: block;

            margin-top: 6px;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 0.12em;

            text-transform: uppercase;

            color: #a18200;
        }


        /* =========================================================
           SIDEBAR SECTION
        ========================================================= */

        .sidebar-section {

            margin-bottom: 13px;
        }


        .sidebar-heading {

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 10px 13px 7px;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: 0.11em;

            color: #9ca3af;
        }


        .sidebar-heading::before {

            content: "";

            width: 4px;

            height: 4px;

            border-radius: 50%;

            background-color: #d4a700;
        }


        /* =========================================================
           MENU CONTAINER
        ========================================================= */

        .sidebar-menu {

            padding: 0 2px;
        }


        /* =========================================================
           MENU LINK
        ========================================================= */

        .sidebar a.menu-link {

            position: relative;

            display: flex;

            align-items: center;

            width: 100%;

            min-height: 45px;

            margin: 4px 0;

            padding: 8px 11px;

            color: #4b5563;

            background-color: transparent;

            text-decoration: none;

            border-radius: 11px;

            font-size: 14px;

            font-weight: 500;

            transition:
                background-color 0.2s ease,
                color 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.2s ease;
        }


        /* =========================================================
           MENU ICON BOX
        ========================================================= */

        .menu-icon {

            width: 34px;

            min-width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 9px;

            border-radius: 9px;

            background-color: #f5f6f8;

            color: #6b7280;

            font-size: 16px;

            line-height: 1;

            transition:
                background-color 0.2s ease,
                color 0.2s ease,
                transform 0.2s ease;
        }


        .menu-text {

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

            flex: 1;
        }


        /* =========================================================
           MENU ARROW
        ========================================================= */

        .menu-arrow {

            margin-left: auto;

            font-size: 13px;

            color: #d1d5db;

            transition:
                color 0.2s ease,
                transform 0.2s ease;
        }


        /* =========================================================
           HOVER
        ========================================================= */

        .sidebar a.menu-link:hover {

            color: #a18200;

            background-color: #fffbea;

            transform: translateX(2px);
        }


        .sidebar a.menu-link:hover .menu-icon {

            background-color: #ffffff;

            color: #d4a700;

            transform: scale(1.04);
        }


        .sidebar a.menu-link:hover .menu-arrow {

            color: #d4a700;

            transform: translateX(2px);
        }


        /* =========================================================
           ACTIVE MENU
        ========================================================= */

        .sidebar a.menu-link.active {

            color: #a18200;

            background:
                linear-gradient(
                    90deg,
                    #fff8d9 0%,
                    #fffbea 100%
                );

            font-weight: 700;

            box-shadow:
                inset 0 0 0 1px rgba(212, 167, 0, 0.08);
        }


        /* indikator kiri */

        .sidebar a.menu-link.active::before {

            content: "";

            position: absolute;

            left: 0;

            top: 9px;

            bottom: 9px;

            width: 3px;

            background-color: #d4a700;

            border-radius:
                0
                5px
                5px
                0;
        }


        .sidebar a.menu-link.active .menu-icon {

            background-color: #ffffff;

            color: #d4a700;

            box-shadow:
                0 3px 8px rgba(212, 167, 0, 0.10);
        }


        .sidebar a.menu-link.active .menu-arrow {

            color: #d4a700;
        }


        .sidebar a.menu-link.active:hover {

            background-color: #fffbea;

            color: #a18200;

            transform: translateX(2px);
        }


        /* =========================================================
           DIVIDER
        ========================================================= */

        .sidebar-divider {

            height: 1px;

            margin: 10px 12px 14px;

            background-color: #f0f1f3;
        }


        /* =========================================================
           USER AREA
        ========================================================= */

        .user-area {

            flex-shrink: 0;

            padding: 12px;

            background-color: #ffffff;

            border-top: 1px solid #e5e7eb;

            box-shadow:
                0 -5px 18px rgba(15, 23, 42, 0.025);
        }


        /* =========================================================
           USER PROFILE CARD
        ========================================================= */

        .user-info {

            display: flex;

            align-items: center;

            padding: 10px;

            margin-bottom: 9px;

            background-color: #f9fafb;

            border: 1px solid #eef0f2;

            border-radius: 12px;

            min-width: 0;
        }


        .user-icon {

            width: 38px;

            min-width: 38px;

            height: 38px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-right: 10px;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #fff8d8,
                    #fffbea
                );

            border: 1px solid #f1e4a8;

            font-size: 17px;

            box-shadow:
                0 3px 8px rgba(212, 167, 0, 0.08);
        }


        .user-details {

            min-width: 0;

            flex: 1;
        }


        .user-name {

            max-width: 155px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: #1f2937;

            font-size: 13px;

            font-weight: 700;
        }


        .user-role {

            display: flex;

            align-items: center;

            gap: 5px;

            margin-top: 2px;

            color: #9ca3af;

            font-size: 10px;

            font-weight: 500;
        }


        .user-status {

            width: 6px;

            height: 6px;

            border-radius: 50%;

            background-color: #22c55e;
        }


        /* =========================================================
           USER MENU
        ========================================================= */

        .user-menu {

            padding: 0;
        }


        .password-link {

            display: flex !important;

            align-items: center;

            min-height: 41px !important;

            margin: 0 0 8px 0 !important;

            padding: 7px 9px !important;

            color: #4b5563 !important;

            background-color: #ffffff !important;

            border: 1px solid #eef0f2;
        }


        .password-link .menu-icon {

            width: 31px;

            min-width: 31px;

            height: 31px;

            margin-right: 8px;

            font-size: 14px;

            background-color: #f7f7f8;
        }


        .password-link:hover {

            color: #a18200 !important;

            background-color: #fffbea !important;

            border-color: #f1e4a8;
        }


        .password-link:hover .menu-icon {

            background-color: #ffffff;

            color: #d4a700;
        }


        .password-link.active {

            color: #a18200 !important;

            background-color: #fffbea !important;

            border-color: #f1e4a8;
        }


        .password-link.active::before {

            display: none;
        }


        /* =========================================================
           LOGOUT FORM
        ========================================================= */

        .logout-form {

            padding: 0;

            margin: 0;
        }


        /* =========================================================
           LOGOUT BUTTON
        ========================================================= */

        .logout-btn {

            width: 100%;

            min-height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            border: 1px solid #f1d3d3 !important;

            border-radius: 10px;

            background-color: #fffafa;

            color: #dc3545;

            font-size: 13px;

            font-weight: 600;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease,
                transform 0.15s ease,
                box-shadow 0.2s ease;
        }


        .logout-btn:hover {

            background-color: #fff1f1;

            border-color: #dc3545 !important;

            color: #c82333;

            transform: translateY(-1px);

            box-shadow:
                0 5px 12px rgba(220, 53, 69, 0.08);
        }


        .logout-btn:active {

            transform: translateY(0);
        }


        .logout-icon {

            font-size: 15px;

            line-height: 1;
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

            min-height: 100vh;

            padding: 30px;
        }


        /* =========================================================
           DEFAULT CARD
        ========================================================= */

        .card {

            border: none;

            border-radius: 14px;

            box-shadow:
                0 3px 15px rgba(15, 23, 42, 0.035);
        }


        /* =========================================================
           TABLE
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

            background-color: #d9dce1;

            border-radius: 10px;
        }


        .sidebar-content::-webkit-scrollbar-thumb:hover {

            background-color: #c5c9cf;
        }


        /* =========================================================
           RESPONSIVE 991px
        ========================================================= */

        @media (max-width: 991px) {

            .sidebar {

                width: 225px;

                min-width: 225px;
            }


            .brand-text {

                font-size: 14px;
            }


            .content {

                padding: 22px;
            }

        }


        /* =========================================================
           RESPONSIVE 767px
        ========================================================= */

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

                border-right: none;

                border-bottom: 1px solid #e5e7eb;

                box-shadow: none;
            }


            .sidebar-content {

                overflow: visible;

                padding: 10px;
            }


            .sidebar .brand {

                min-height: 70px;

                margin-bottom: 12px;
            }


            .sidebar-heading {

                padding-top: 12px;
            }


            .user-area {

                display: none;
            }


            .main-content {

                width: 100%;
            }


            .content {

                min-height: auto;

                padding: 15px;
            }

        }


        /* =========================================================
           RESPONSIVE 480px
        ========================================================= */

        @media (max-width: 480px) {

            .sidebar .brand {

                min-height: 64px;

                padding: 10px 12px;
            }


            .brand-icon-box {

                width: 40px;

                min-width: 40px;

                height: 40px;

                font-size: 20px;
            }


            .brand-text {

                font-size: 13px;
            }


            .brand-subtitle {

                font-size: 8px;
            }


            .sidebar a.menu-link {

                min-height: 43px;

                font-size: 13px;
            }


            .content {

                padding: 12px;
            }

        }

    </style>

</head>


<body>


<div class="app-wrapper">


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside class="sidebar">


        {{-- =====================================================
             SIDEBAR CONTENT
        ====================================================== --}}

        <div class="sidebar-content">


            {{-- =================================================
                 BRAND
            ================================================== --}}

            <div class="brand">

                <div class="brand-icon-box">
                    🏪
                </div>


                <div class="brand-content">

                    <span class="brand-text">
                        Perabot Heri Grosir
                    </span>

                    <span class="brand-subtitle">
                        Sistem Gudang
                    </span>

                </div>

            </div>



            {{-- =================================================
                 DASHBOARD
            ================================================== --}}

            <div class="sidebar-section">

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

                        <span class="menu-arrow">
                            ›
                        </span>

                    </a>

                </div>

            </div>



            {{-- =================================================
                 MASTER DATA
            ================================================== --}}

            <div class="sidebar-section">


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

                        <span class="menu-arrow">
                            ›
                        </span>

                    </a>


                </div>

            </div>



            {{-- =================================================
                 TRANSAKSI
            ================================================== --}}

            <div class="sidebar-section">


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

                        <span class="menu-arrow">
                            ›
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

                        <span class="menu-arrow">
                            ›
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

                        <span class="menu-arrow">
                            ›
                        </span>

                    </a>


                </div>

            </div>



            {{-- =================================================
                 LAPORAN
            ================================================== --}}

            <div class="sidebar-section">


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
                            Barang
                        </span>

                        <span class="menu-arrow">
                            ›
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

                        <span class="menu-arrow">
                            ›
                        </span>

                    </a>


                </div>

            </div>


        </div>



        {{-- =====================================================
             USER AREA
        ====================================================== --}}

        <div class="user-area">


            {{-- =================================================
                 USER PROFILE
            ================================================== --}}

            @auth

                <div class="user-info">


                    <div class="user-icon">
                        👤
                    </div>


                    <div class="user-details">


                        <div class="user-name">

                            {{ Auth::user()?->name ?? 'Admin Gudang' }}

                        </div>


                        <div class="user-role">

                            <span class="user-status"></span>

                            <span>
                                Admin Gudang
                            </span>

                        </div>


                    </div>


                </div>

            @endauth



            {{-- =================================================
                 USER MENU
            ================================================== --}}

            <div class="user-menu">


                {{-- GANTI PASSWORD --}}

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

                    <span class="menu-arrow">
                        ›
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
                            class="logout-btn"
                        >

                            <span class="logout-icon">
                                🚪
                            </span>

                            <span>
                                Logout
                            </span>

                        </button>

                    </form>

                @endauth


            </div>


        </div>


    </aside>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main class="main-content">


        <div class="content">

            @yield('content')

        </div>


    </main>


</div>



{{-- =========================================================
     BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>