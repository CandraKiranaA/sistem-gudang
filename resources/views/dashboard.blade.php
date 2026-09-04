@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>

    /* =========================================================
       DASHBOARD PAGE
    ========================================================= */

    .dashboard-page {
        width: 100%;
        max-width: 100%;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .dashboard-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;

        margin-bottom: 26px;
    }


    .dashboard-header-left {
        min-width: 0;
    }


    .dashboard-kicker {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        margin-bottom: 7px;

        color: #a18200;

        font-size: 11px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: 0.10em;
    }


    .dashboard-kicker-dot {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background-color: #d4a700;

        box-shadow:
            0 0 0 4px rgba(212, 167, 0, 0.10);
    }


    .dashboard-title-main {
        margin: 0 0 5px 0;

        color: #111827;

        font-size: 28px;
        font-weight: 800;

        line-height: 1.2;

        letter-spacing: -0.5px;
    }


    .dashboard-subtitle {
        margin: 0;

        color: #6b7280;

        font-size: 14px;
    }


    /* =========================================================
       HEADER RIGHT
    ========================================================= */

    .dashboard-date {
        flex-shrink: 0;

        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px 13px;

        background-color: #ffffff;

        border: 1px solid #e5e7eb;

        border-radius: 11px;

        color: #6b7280;

        font-size: 12px;
        font-weight: 600;

        box-shadow:
            0 3px 12px rgba(15, 23, 42, 0.035);
    }


    .dashboard-date-icon {
        width: 30px;
        height: 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background-color: #fffbea;

        border: 1px solid #f1e4a8;

        font-size: 14px;
    }


    /* =========================================================
       STATISTICS
    ========================================================= */

    .dashboard-statistics {
        margin-top: 0;
    }


    /* =========================================================
       STAT CARD LINK
    ========================================================= */

    .dashboard-link {
        display: block;

        height: 100%;

        color: inherit;

        text-decoration: none;
    }


    /* =========================================================
       STAT CARD
    ========================================================= */

    .dashboard-card {

        position: relative;

        height: 166px;

        border: 1px solid #e9eaed !important;

        border-radius: 15px !important;

        background-color: #ffffff;

        overflow: hidden;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;

        box-shadow:
            0 4px 16px rgba(15, 23, 42, 0.045) !important;
    }


    /* =========================================================
       CARD TOP ACCENT
    ========================================================= */

    .dashboard-card::before {

        content: "";

        position: absolute;

        top: 0;
        left: 0;

        width: 100%;
        height: 3px;

        background-color: #d4a700;
    }


    /* =========================================================
       CARD DECORATION
    ========================================================= */

    .dashboard-card::after {

        content: "";

        position: absolute;

        width: 110px;
        height: 110px;

        right: -45px;
        bottom: -55px;

        border-radius: 50%;

        background-color:
            rgba(212, 167, 0, 0.045);

        pointer-events: none;
    }


    /* =========================================================
       CARD BODY
    ========================================================= */

    .dashboard-card-body {

        position: relative;

        z-index: 2;

        height: 100%;

        padding: 19px;

        display: flex;

        flex-direction: column;

        justify-content: space-between;
    }


    /* =========================================================
       CARD HEADER
    ========================================================= */

    .dashboard-card-top {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 10px;
    }


    /* =========================================================
       CARD ICON
    ========================================================= */

    .dashboard-icon {

        width: 42px;
        height: 42px;

        min-width: 42px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background:
            linear-gradient(
                135deg,
                #fff8d8,
                #fffbea
            );

        border: 1px solid #f1e4a8;

        font-size: 19px;

        box-shadow:
            0 4px 10px rgba(212, 167, 0, 0.08);
    }


    /* =========================================================
       CARD ARROW
    ========================================================= */

    .dashboard-arrow {

        width: 29px;
        height: 29px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background-color: #f8f9fa;

        color: #9ca3af;

        font-size: 16px;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }


    /* =========================================================
       CARD TITLE
    ========================================================= */

    .dashboard-title {

        margin-top: 9px;

        color: #6b7280;

        font-size: 12px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 0.045em;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================================================
       CARD BOTTOM
    ========================================================= */

    .dashboard-card-bottom {

        display: flex;

        align-items: flex-end;

        justify-content: space-between;

        gap: 10px;
    }


    /* =========================================================
       NUMBER
    ========================================================= */

    .dashboard-number {

        margin: 0;

        color: #111827;

        font-size: 28px;

        line-height: 1;

        font-weight: 800;

        letter-spacing: -0.7px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================================================
       DESCRIPTION
    ========================================================= */

    .dashboard-description {

        margin-top: 6px;

        color: #9ca3af;

        font-size: 11px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================================================
       CARD HOVER
    ========================================================= */

    .dashboard-card:hover {

        transform: translateY(-4px);

        border-color: #f1e4a8 !important;

        box-shadow:
            0 12px 26px rgba(15, 23, 42, 0.09) !important;
    }


    .dashboard-card:hover .dashboard-arrow {

        background-color: #fffbea;

        color: #d4a700;

        transform: translateX(2px);
    }


    .dashboard-card:hover .dashboard-icon {

        box-shadow:
            0 6px 14px rgba(212, 167, 0, 0.14);

        transform: scale(1.03);
    }


    /* =========================================================
       QUICK ACCESS
    ========================================================= */

    .dashboard-lower {

        margin-top: 24px;
    }


    .dashboard-section-card {

        height: 100%;

        padding: 21px;

        background-color: #ffffff;

        border: 1px solid #e8eaed;

        border-radius: 15px;

        box-shadow:
            0 4px 16px rgba(15, 23, 42, 0.035);
    }


    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .dashboard-section-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 10px;

        margin-bottom: 17px;
    }


    .dashboard-section-heading {

        display: flex;

        align-items: center;

        gap: 10px;
    }


    .section-icon {

        width: 36px;
        height: 36px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background-color: #fffbea;

        border: 1px solid #f1e4a8;

        font-size: 16px;
    }


    .dashboard-section-title {

        margin: 0;

        color: #1f2937;

        font-size: 15px;

        font-weight: 800;
    }


    .dashboard-section-subtitle {

        margin: 2px 0 0 0;

        color: #9ca3af;

        font-size: 11px;
    }


    /* =========================================================
       QUICK ACTION
    ========================================================= */

    .quick-action {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        padding: 11px;

        margin-bottom: 8px;

        background-color: #fafafa;

        border: 1px solid #eeeeef;

        border-radius: 10px;

        color: inherit;

        text-decoration: none;

        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            transform 0.15s ease;
    }


    .quick-action:last-child {
        margin-bottom: 0;
    }


    .quick-action:hover {

        background-color: #fffbea;

        border-color: #f1e4a8;

        transform: translateX(2px);
    }


    .quick-action-left {

        display: flex;

        align-items: center;

        gap: 10px;

        min-width: 0;
    }


    .quick-action-icon {

        width: 34px;
        height: 34px;

        min-width: 34px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background-color: #ffffff;

        border: 1px solid #eceef0;

        font-size: 15px;
    }


    .quick-action-text {

        min-width: 0;
    }


    .quick-action-title {

        color: #374151;

        font-size: 12px;

        font-weight: 700;
    }


    .quick-action-description {

        margin-top: 2px;

        color: #9ca3af;

        font-size: 10px;
    }


    .quick-action-arrow {

        color: #c0c4c9;

        font-size: 16px;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }


    .quick-action:hover .quick-action-arrow {

        color: #d4a700;

        transform: translateX(2px);
    }


    /* =========================================================
       SYSTEM INFORMATION
    ========================================================= */

    .system-info {

        position: relative;

        height: 100%;

        min-height: 250px;

        padding: 23px;

        border-radius: 15px;

        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                #fffbea 0%,
                #fffdf7 52%,
                #ffffff 100%
            );

        border: 1px solid #f0e4ae;
    }


    .system-info::before {

        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        border-radius: 50%;

        right: -75px;
        top: -75px;

        background-color:
            rgba(212, 167, 0, 0.07);
    }


    .system-info::after {

        content: "";

        position: absolute;

        width: 120px;
        height: 120px;

        border-radius: 50%;

        left: -65px;
        bottom: -65px;

        background-color:
            rgba(212, 167, 0, 0.045);
    }


    .system-info-content {

        position: relative;

        z-index: 2;
    }


    .system-info-badge {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding: 6px 9px;

        margin-bottom: 15px;

        background-color: #ffffff;

        border: 1px solid #f0df91;

        border-radius: 8px;

        color: #a18200;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 0.07em;
    }


    .system-info-title {

        margin: 0 0 9px 0;

        color: #1f2937;

        font-size: 20px;

        font-weight: 800;

        letter-spacing: -0.3px;
    }


    .system-info-description {

        max-width: 600px;

        margin: 0;

        color: #6b7280;

        font-size: 12px;

        line-height: 1.7;
    }


    /* =========================================================
       SYSTEM FEATURES
    ========================================================= */

    .system-features {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 9px;

        margin-top: 19px;
    }


    .system-feature {

        display: flex;

        align-items: center;

        gap: 8px;

        padding: 9px 10px;

        background-color:
            rgba(255, 255, 255, 0.78);

        border: 1px solid #f0ead0;

        border-radius: 9px;

        color: #6b7280;

        font-size: 10px;

        font-weight: 600;
    }


    .system-feature-icon {

        width: 20px;
        height: 20px;

        min-width: 20px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 6px;

        background-color: #fffbea;

        color: #a18200;

        font-size: 10px;
    }


    /* =========================================================
       SYSTEM FOOTER
    ========================================================= */

    .system-info-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 10px;

        margin-top: 18px;

        padding-top: 14px;

        border-top: 1px solid #f0e7bd;

        color: #a18200;

        font-size: 10px;

        font-weight: 600;
    }


    .system-status {

        display: flex;

        align-items: center;

        gap: 6px;
    }


    .system-status-dot {

        width: 7px;
        height: 7px;

        border-radius: 50%;

        background-color: #22c55e;

        box-shadow:
            0 0 0 3px rgba(34, 197, 94, 0.10);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1199.98px) {

        .dashboard-card {
            height: 160px;
        }

        .dashboard-number {
            font-size: 26px;
        }

    }


    @media (max-width: 991.98px) {

        .dashboard-header {
            align-items: flex-start;
        }


        .dashboard-date {
            display: none;
        }


        .dashboard-card {
            height: 158px;
        }

    }


    @media (max-width: 767.98px) {

        .dashboard-header {
            margin-bottom: 20px;
        }


        .dashboard-title-main {
            font-size: 24px;
        }


        .dashboard-subtitle {
            font-size: 13px;
        }


        .dashboard-card {
            height: 150px;
        }


        .dashboard-card-body {
            padding: 17px;
        }


        .dashboard-number {
            font-size: 25px;
        }


        .dashboard-lower {
            margin-top: 18px;
        }


        .system-features {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 575.98px) {

        .dashboard-kicker {
            font-size: 9px;
        }


        .dashboard-title-main {
            font-size: 22px;
        }


        .dashboard-card {
            height: 145px;
        }


        .dashboard-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;

            font-size: 17px;
        }


        .dashboard-number {
            font-size: 23px;
        }


        .dashboard-section-card,
        .system-info {
            padding: 18px;
        }

    }

</style>


<div class="dashboard-page">


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="dashboard-header">


        <div class="dashboard-header-left">


            <div class="dashboard-kicker">

                <span class="dashboard-kicker-dot"></span>

                <span>
                    Sistem Gudang
                </span>

            </div>


            <h1 class="dashboard-title-main">
                Dashboard
            </h1>


            <p class="dashboard-subtitle">

                Selamat datang kembali,
                <strong>
                    {{ Auth::user()->name }}
                </strong>
                👋

            </p>


        </div>



        {{-- DATE --}}

        <div class="dashboard-date">

            <div class="dashboard-date-icon">
                📅
            </div>

            <div>
                {{ now()->translatedFormat('d F Y') }}
            </div>

        </div>


    </div>



    {{-- =========================================================
         STATISTIK
    ========================================================== --}}

    <div class="row g-3 dashboard-statistics">


        {{-- =====================================================
             TOTAL BARANG
        ====================================================== --}}

        <div class="col-xl col-lg-4 col-md-6">

            <a
                href="{{ route('barangs.index') }}"
                class="dashboard-link"
            >

                <div class="card dashboard-card">


                    <div class="dashboard-card-body">


                        <div>


                            <div class="dashboard-card-top">

                                <div class="dashboard-icon">
                                    📦
                                </div>


                                <div class="dashboard-arrow">
                                    →
                                </div>

                            </div>


                            <div class="dashboard-title">
                                Total Barang
                            </div>


                        </div>


                        <div class="dashboard-card-bottom">


                            <div>

                                <div class="dashboard-number">
                                    {{ number_format($totalBarang, 0, ',', '.') }}
                                </div>

                                <div class="dashboard-description">
                                    Jenis barang
                                </div>

                            </div>


                        </div>


                    </div>

                </div>

            </a>

        </div>



        {{-- =====================================================
             BARANG MASUK
        ====================================================== --}}

        <div class="col-xl col-lg-4 col-md-6">

            <a
                href="{{ route('barang-masuk.index') }}"
                class="dashboard-link"
            >

                <div class="card dashboard-card">


                    <div class="dashboard-card-body">


                        <div>


                            <div class="dashboard-card-top">

                                <div class="dashboard-icon">
                                    📥
                                </div>


                                <div class="dashboard-arrow">
                                    →
                                </div>

                            </div>


                            <div class="dashboard-title">
                                Barang Masuk
                            </div>


                        </div>


                        <div class="dashboard-card-bottom">

                            <div>

                                <div class="dashboard-number">
                                    {{ number_format($totalBarangMasuk, 0, ',', '.') }}
                                </div>

                                <div class="dashboard-description">
                                    Total koli
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </a>

        </div>



        {{-- =====================================================
             BARANG KELUAR
        ====================================================== --}}

        <div class="col-xl col-lg-4 col-md-6">

            <a
                href="{{ route('penjualan.index') }}"
                class="dashboard-link"
            >

                <div class="card dashboard-card">


                    <div class="dashboard-card-body">


                        <div>


                            <div class="dashboard-card-top">

                                <div class="dashboard-icon">
                                    📤
                                </div>


                                <div class="dashboard-arrow">
                                    →
                                </div>

                            </div>


                            <div class="dashboard-title">
                                Barang Keluar
                            </div>


                        </div>


                        <div class="dashboard-card-bottom">

                            <div>

                                <div class="dashboard-number">
                                    {{ number_format($totalBarangKeluar, 0, ',', '.') }}
                                </div>

                                <div class="dashboard-description">
                                    Total pcs
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </a>

        </div>



        {{-- =====================================================
             TOTAL NOTA
        ====================================================== --}}

        <div class="col-xl col-lg-4 col-md-6">

            <a
                href="{{ route('penjualan.index') }}"
                class="dashboard-link"
            >

                <div class="card dashboard-card">


                    <div class="dashboard-card-body">


                        <div>


                            <div class="dashboard-card-top">

                                <div class="dashboard-icon">
                                    🧾
                                </div>


                                <div class="dashboard-arrow">
                                    →
                                </div>

                            </div>


                            <div class="dashboard-title">
                                Total Nota
                            </div>


                        </div>


                        <div class="dashboard-card-bottom">

                            <div>

                                <div class="dashboard-number">
                                    {{ number_format($totalNota, 0, ',', '.') }}
                                </div>

                                <div class="dashboard-description">
                                    Transaksi penjualan
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </a>

        </div>



        {{-- =====================================================
             CUSTOMER
        ====================================================== --}}

        <div class="col-xl col-lg-4 col-md-6">

            <a
                href="{{ route('customers.index') }}"
                class="dashboard-link"
            >

                <div class="card dashboard-card">


                    <div class="dashboard-card-body">


                        <div>


                            <div class="dashboard-card-top">

                                <div class="dashboard-icon">
                                    👥
                                </div>


                                <div class="dashboard-arrow">
                                    →
                                </div>

                            </div>


                            <div class="dashboard-title">
                                Customer
                            </div>


                        </div>


                        <div class="dashboard-card-bottom">

                            <div>

                                <div class="dashboard-number">
                                    {{ number_format($totalCustomer, 0, ',', '.') }}
                                </div>

                                <div class="dashboard-description">
                                    Customer terdaftar
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </a>

        </div>


    </div>



    {{-- =========================================================
         LOWER DASHBOARD
    ========================================================== --}}

    <div class="row g-3 dashboard-lower">


        {{-- =====================================================
             AKSES CEPAT
        ====================================================== --}}

        <div class="col-lg-5">


            <div class="dashboard-section-card">


                <div class="dashboard-section-header">


                    <div class="dashboard-section-heading">

                        <div class="section-icon">
                            ⚡
                        </div>


                        <div>

                            <h5 class="dashboard-section-title">
                                Akses Cepat
                            </h5>

                            <p class="dashboard-section-subtitle">
                                Menu yang sering digunakan
                            </p>

                        </div>

                    </div>


                </div>



                {{-- DATA BARANG --}}

                <a
                    href="{{ route('barangs.index') }}"
                    class="quick-action"
                >

                    <div class="quick-action-left">

                        <div class="quick-action-icon">
                            📦
                        </div>


                        <div class="quick-action-text">

                            <div class="quick-action-title">
                                Kelola Data Barang
                            </div>

                            <div class="quick-action-description">
                                Tambah dan lihat stok barang
                            </div>

                        </div>

                    </div>


                    <div class="quick-action-arrow">
                        →
                    </div>

                </a>



                {{-- STOCK IN --}}

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="quick-action"
                >

                    <div class="quick-action-left">

                        <div class="quick-action-icon">
                            📥
                        </div>


                        <div class="quick-action-text">

                            <div class="quick-action-title">
                                Barang Masuk
                            </div>

                            <div class="quick-action-description">
                                Catat penerimaan barang
                            </div>

                        </div>

                    </div>


                    <div class="quick-action-arrow">
                        →
                    </div>

                </a>



                {{-- BUAT NOTA --}}

                <a
                    href="{{ route('penjualan.create') }}"
                    class="quick-action"
                >

                    <div class="quick-action-left">

                        <div class="quick-action-icon">
                            🧾
                        </div>


                        <div class="quick-action-text">

                            <div class="quick-action-title">
                                Buat Nota
                            </div>

                            <div class="quick-action-description">
                                Buat transaksi penjualan baru
                            </div>

                        </div>

                    </div>


                    <div class="quick-action-arrow">
                        →
                    </div>

                </a>



                {{-- LAPORAN --}}

                <a
                    href="{{ route('laporan.barang.index') }}"
                    class="quick-action"
                >

                    <div class="quick-action-left">

                        <div class="quick-action-icon">
                            📊
                        </div>


                        <div class="quick-action-text">

                            <div class="quick-action-title">
                                Laporan Barang
                            </div>

                            <div class="quick-action-description">
                                Lihat stok dan riwayat barang
                            </div>

                        </div>

                    </div>


                    <div class="quick-action-arrow">
                        →
                    </div>

                </a>


            </div>

        </div>



        {{-- =====================================================
             SISTEM GUDANG
        ====================================================== --}}

        <div class="col-lg-7">


            <div class="system-info">


                <div class="system-info-content">


                    <div class="system-info-badge">

                        <span>
                            🏪
                        </span>

                        <span>
                            Sistem Gudang
                        </span>

                    </div>


                    <h3 class="system-info-title">
                        Kelola Gudang Lebih Mudah
                    </h3>


                    <p class="system-info-description">

                        Gunakan sistem ini untuk mengelola data barang,
                        memantau stok masuk dan keluar, mencatat transaksi
                        penjualan, serta melihat laporan gudang secara
                        lebih terorganisir.

                    </p>



                    {{-- FEATURES --}}

                    <div class="system-features">


                        <div class="system-feature">

                            <div class="system-feature-icon">
                                ✓
                            </div>

                            <span>
                                Data barang terorganisir
                            </span>

                        </div>


                        <div class="system-feature">

                            <div class="system-feature-icon">
                                ✓
                            </div>

                            <span>
                                Stok mudah dipantau
                            </span>

                        </div>


                        <div class="system-feature">

                            <div class="system-feature-icon">
                                ✓
                            </div>

                            <span>
                                Transaksi tercatat
                            </span>

                        </div>


                        <div class="system-feature">

                            <div class="system-feature-icon">
                                ✓
                            </div>

                            <span>
                                Laporan lebih rapi
                            </span>

                        </div>


                    </div>



                    {{-- FOOTER --}}

                    <div class="system-info-footer">


                        <div class="system-status">

                            <span class="system-status-dot"></span>

                            <span>
                                Sistem aktif
                            </span>

                        </div>


                        <div>
                            Perabot Heri Grosir
                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>


</div>

@endsection