@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Dashboard
        </h2>

        <p class="text-muted mb-0">
            Selamat datang, {{ Auth::user()->name }} 👋
        </p>
    </div>

</div>


{{-- =====================================================
     STATISTIK
====================================================== --}}

<div class="row g-3 dashboard-statistics">


    {{-- =================================================
         TOTAL BARANG
    ================================================== --}}

    <div class="col-xl col-lg-4 col-md-6">

        <a href="{{ route('barangs.index') }}"
           class="dashboard-link">

            <div class="card shadow-sm dashboard-card">

                <div class="dashboard-card-body">

                    <div class="dashboard-title">
                        📦 Total Barang
                    </div>

                    <div class="dashboard-number">
                        {{ number_format($totalBarang, 0, ',', '.') }}
                    </div>

                    <div class="dashboard-description">
                        Jenis barang
                    </div>

                </div>

            </div>

        </a>

    </div>


    {{-- =================================================
         BARANG MASUK
    ================================================== --}}

    <div class="col-xl col-lg-4 col-md-6">

        <a href="{{ route('barang-masuk.index') }}"
           class="dashboard-link">

            <div class="card shadow-sm dashboard-card">

                <div class="dashboard-card-body">

                    <div class="dashboard-title">
                        📥 Barang Masuk
                    </div>

                    <div class="dashboard-number">
                        {{ number_format($totalBarangMasuk, 0, ',', '.') }}
                    </div>

                    <div class="dashboard-description">
                        Total koli
                    </div>

                </div>

            </div>

        </a>

    </div>


    {{-- =================================================
         BARANG KELUAR
    ================================================== --}}

    <div class="col-xl col-lg-4 col-md-6">

        <a href="{{ route('penjualan.index') }}"
           class="dashboard-link">

            <div class="card shadow-sm dashboard-card">

                <div class="dashboard-card-body">

                    <div class="dashboard-title">
                        📤 Barang Keluar
                    </div>

                    <div class="dashboard-number">
                        {{ number_format($totalBarangKeluar, 0, ',', '.') }}
                    </div>

                    <div class="dashboard-description">
                        Total pcs
                    </div>

                </div>

            </div>

        </a>

    </div>


    {{-- =================================================
         TOTAL NOTA
    ================================================== --}}

    <div class="col-xl col-lg-4 col-md-6">

        <a href="{{ route('penjualan.index') }}"
           class="dashboard-link">

            <div class="card shadow-sm dashboard-card">

                <div class="dashboard-card-body">

                    <div class="dashboard-title">
                        🧾 Total Nota
                    </div>

                    <div class="dashboard-number">
                        {{ number_format($totalNota, 0, ',', '.') }}
                    </div>

                    <div class="dashboard-description">
                        Transaksi penjualan
                    </div>

                </div>

            </div>

        </a>

    </div>


    {{-- =================================================
         CUSTOMER
    ================================================== --}}

    <div class="col-xl col-lg-4 col-md-6">

        <a href="{{ route('customers.index') }}"
           class="dashboard-link">

            <div class="card shadow-sm dashboard-card">

                <div class="dashboard-card-body">

                    <div class="dashboard-title">
                        👥 Customer
                    </div>

                    <div class="dashboard-number">
                        {{ number_format($totalCustomer, 0, ',', '.') }}
                    </div>

                    <div class="dashboard-description">
                        Customer terdaftar
                    </div>

                </div>

            </div>

        </a>

    </div>


</div>


{{-- =====================================================
     WELCOME
====================================================== --}}

<div class="card shadow-sm mt-4 welcome-card">

    <h5 class="fw-bold mb-2">
        Sistem Gudang
    </h5>

    <p class="text-muted mb-0">
        Gunakan menu di sebelah kiri untuk mengelola
        data barang, barang masuk, nota penjualan,
        customer, dan barang keluar.
    </p>

</div>


{{-- =====================================================
     STYLE DASHBOARD
====================================================== --}}

<style>

    /* =====================================================
       LINK CARD
    ====================================================== */

    .dashboard-link {
        text-decoration: none;
        color: inherit;
        display: block;
        height: 100%;
    }


    /* =====================================================
       CARD
    ====================================================== */

    .dashboard-card {
        border: none;
        border-radius: 12px;
        height: 150px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        overflow: hidden;
    }


    /* =====================================================
       CARD BODY
    ====================================================== */

    .dashboard-card-body {
        height: 100%;
        padding: 20px;

        display: flex;
        flex-direction: column;
        justify-content: center;

        min-width: 0;
    }


    /* =====================================================
       JUDUL
    ====================================================== */

    .dashboard-title {
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

        margin-bottom: 8px;
    }


    /* =====================================================
       ANGKA
    ====================================================== */

    .dashboard-number {
        color: #111827;
        font-size: 28px;
        font-weight: 700;
        line-height: 1.2;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

        margin-bottom: 4px;
    }


    /* =====================================================
       KETERANGAN
    ====================================================== */

    .dashboard-description {
        color: #9ca3af;
        font-size: 12px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* =====================================================
       HOVER
    ====================================================== */

    .dashboard-card:hover {
        background-color: #fff3cd;
        transform: translateY(-4px);

        box-shadow:
            0 8px 20px rgba(0, 0, 0, 0.10) !important;
    }


    /* =====================================================
       WELCOME
    ====================================================== */

    .welcome-card {
        border-radius: 12px;
        padding: 24px;
    }


    /* =====================================================
       TABLET
    ====================================================== */

    @media (max-width: 1199.98px) {

        .dashboard-card {
            height: 145px;
        }

    }


    /* =====================================================
       MOBILE
    ====================================================== */

    @media (max-width: 767.98px) {

        .dashboard-card {
            height: 140px;
        }

        .dashboard-card-body {
            padding: 18px;
        }

        .dashboard-number {
            font-size: 25px;
        }

    }

</style>

@endsection