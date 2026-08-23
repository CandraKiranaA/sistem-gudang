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

        .sidebar .submenu a {
            padding: 10px 20px 10px 50px;
            font-size: 14px;
            margin: 2px 12px;
        }

        .sidebar .submenu a:hover {
            background-color: #f3f4ff;
        }

        .content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .menu-arrow {
            transition: transform 0.2s;
        }

        .menu-arrow.rotate {
            transform: rotate(180deg);
        }

    </style>

</head>


<body>

<div class="container-fluid">

    <div class="row">


        {{-- ===================================================== --}}
        {{-- SIDEBAR --}}
        {{-- ===================================================== --}}

        <div class="col-md-2 sidebar p-0">


            {{-- BRAND --}}
            <div class="brand">
                📦 Sistem Gudang
            </div>


            {{-- ================================================= --}}
            {{-- DASHBOARD --}}
            {{-- ================================================= --}}

            <a
                href="/dashboard"
                class="{{ request()->is('dashboard') ? 'active' : '' }}"
            >
                🏠 Dashboard
            </a>


            {{-- ================================================= --}}
            {{-- DATA BARANG DROPDOWN --}}
            {{-- ================================================= --}}

            <a
                href="#dataBarangMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="{{ request()->routeIs('barangs.*') ? 'true' : 'false' }}"
                aria-controls="dataBarangMenu"
                class="d-flex justify-content-between align-items-center"
            >

                <span>
                    📦 Data Master
                </span>

                <span
                    class="menu-arrow
                    {{ request()->routeIs('barangs.*') ? 'rotate' : '' }}"
                >
                    ▼
                </span>

            </a>


            {{-- SUBMENU DATA BARANG --}}

            <div
                class="collapse submenu
                {{ request()->routeIs('barangs.index') ? 'show' : '' }}"
                id="dataBarangMenu"
            >

                {{-- Daftar Barang --}}
                <a
                    href="{{ route('barangs.index') }}"
                    class="{{ request()->routeIs('barangs.create') ? 'active' : '' }}"
                >
                    Barang
                </a>



            </div>


            {{-- ================================================= --}}
            {{-- BARANG MASUK --}}
            {{-- ================================================= --}}

            <a
                href="{{ route('barang-masuk.index') }}"
                class="{{ request()->routeIs('barang-masuk.*') ? 'active' : '' }}"
            >
                📥 Stock In
            </a>


            {{-- ================================================= --}}
            {{-- BUAT NOTA --}}
            {{-- ================================================= --}}

            <a href="#">
                🧾 Buat Nota
            </a>


            {{-- ================================================= --}}
            {{-- BARANG KELUAR --}}
            {{-- ================================================= --}}

            <a href="#">
                📤 Stock Out
            </a>


            <hr>


            {{-- ================================================= --}}
            {{-- USER --}}
            {{-- ================================================= --}}

            <div class="px-3 mb-3">

                <div class="d-flex align-items-center mb-3">


                    {{-- ICON USER --}}
                    <div class="me-2">
                        👤
                    </div>


                    {{-- INFORMASI USER --}}
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

            </div>


            {{-- ================================================= --}}
            {{-- LOGOUT --}}
            {{-- ================================================= --}}

            @auth

                <form
                    action="/logout"
                    method="POST"
                    class="px-3"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-outline-danger w-100"
                    >
                        🚪 Logout
                    </button>

                </form>

            @endauth


        </div>


        {{-- ===================================================== --}}
        {{-- CONTENT --}}
        {{-- ===================================================== --}}

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


<script>

document.addEventListener('DOMContentLoaded', function () {

    const menu =
        document.getElementById('dataBarangMenu');

    const button =
        document.querySelector(
            '[href="#dataBarangMenu"]'
        );

    const arrow =
        button?.querySelector('.menu-arrow');


    if (menu && arrow) {

        menu.addEventListener(
            'shown.bs.collapse',
            function () {
                arrow.classList.add('rotate');
            }
        );

        menu.addEventListener(
            'hidden.bs.collapse',
            function () {
                arrow.classList.remove('rotate');
            }
        );

    }

});

</script>


</body>

</html>