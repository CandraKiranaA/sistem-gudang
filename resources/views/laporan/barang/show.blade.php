@extends('layouts.app')

@section('title', 'Detail Laporan Barang')

@section('content')

<style>

/* =========================================================
   DETAIL LAPORAN BARANG
   THEME:
   WHITE / SOFT GRAY / CREAM / GOLD
========================================================= */

.detail-page {
    width: 100%;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.detail-page-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;

    margin-bottom: 24px;
}

.detail-title-area {
    min-width: 0;
}

.detail-title {
    margin: 0;

    color: #1f2937;

    font-size: 24px;
    font-weight: 750;

    letter-spacing: -0.4px;
}

.detail-breadcrumb {
    margin-top: 5px;

    color: #9ca3af;

    font-size: 12.5px;
}

.detail-breadcrumb span {
    color: #c0a52b;
    font-weight: 600;
}

.detail-breadcrumb strong {
    color: #6b7280;
    font-weight: 600;
}


/* =========================================================
   BACK BUTTON
========================================================= */

.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-height: 38px;

    padding: 8px 14px;

    background: #ffffff;

    border: 1px solid #dedfe2;
    border-radius: 8px;

    color: #5f6670 !important;

    text-decoration: none;

    font-size: 12px;
    font-weight: 650;

    white-space: nowrap;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .15s ease,
        box-shadow .2s ease;
}

.back-btn:hover {
    background: #fffbea;

    border-color: #eadb91;

    color: #967900 !important;

    transform: translateX(-2px);

    box-shadow:
        0 4px 10px rgba(212, 167, 0, 0.07);
}

.back-icon {
    font-size: 15px;
    line-height: 1;
}


/* =========================================================
   GENERAL CARD
========================================================= */

.detail-card {
    margin-bottom: 22px;

    background: #ffffff;

    border: 1px solid #e5e7eb;
    border-radius: 14px;

    overflow: hidden;

    box-shadow:
        0 3px 15px rgba(15, 23, 42, 0.035);
}


/* =========================================================
   CARD HEADER
========================================================= */

.detail-card-header {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 17px 20px;

    border-bottom: 1px solid #f0f1f3;
}

.card-header-icon {
    width: 40px;
    min-width: 40px;
    height: 40px;

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

    border: 1px solid #f0e4ae;

    font-size: 18px;

    box-shadow:
        0 3px 8px rgba(212, 167, 0, 0.06);
}

.card-header-text {
    min-width: 0;
}

.card-title {
    margin: 0;

    color: #1f2937;

    font-size: 15.5px;
    font-weight: 750;
}

.card-description {
    margin: 4px 0 0;

    color: #9ca3af;

    font-size: 11.5px;
}


/* =========================================================
   INFORMATION BODY
========================================================= */

.info-body {
    padding: 20px;
}

.info-item {
    position: relative;

    height: 100%;

    padding: 16px 17px;

    background: #fafafa;

    border: 1px solid #e7e8eb;
    border-radius: 10px;

    transition:
        border-color .2s ease,
        background-color .2s ease,
        transform .15s ease;
}

.info-item:hover {
    background: #fffdf6;

    border-color: #eadb91;

    transform: translateY(-1px);
}

.info-item::before {
    content: "";

    position: absolute;

    left: 0;
    top: 15px;
    bottom: 15px;

    width: 3px;

    border-radius: 0 4px 4px 0;

    background: #d4a700;

    opacity: .8;
}

.info-label {
    display: block;

    margin-bottom: 7px;
    padding-left: 3px;

    color: #9ca3af;

    font-size: 10.5px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .05em;
}

.info-value {
    padding-left: 3px;

    color: #374151;

    font-size: 14px;
    font-weight: 700;
}

.info-value small {
    color: #9ca3af;

    font-size: 11px;
    font-weight: 500;
}


/* =========================================================
   SUMMARY GRID
========================================================= */

.summary-body {
    padding: 20px;
}

.summary-item {
    position: relative;

    height: 100%;

    padding: 17px;

    background: #fafafa;

    border: 1px solid #e7e8eb;
    border-radius: 10px;

    overflow: hidden;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        transform .15s ease,
        box-shadow .2s ease;
}

.summary-item:hover {
    background: #fffdf6;

    border-color: #eadb91;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(15, 23, 42, 0.035);
}

.summary-item::after {
    content: "";

    position: absolute;

    width: 80px;
    height: 80px;

    right: -35px;
    top: -35px;

    border-radius: 50%;

    background: rgba(212, 167, 0, .045);
}

.summary-label {
    display: block;

    margin-bottom: 7px;

    color: #9ca3af;

    font-size: 10.5px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .04em;
}

.summary-value {
    color: #374151;

    font-size: 18px;
    font-weight: 750;

    line-height: 1.25;
}

.summary-sub {
    display: block;

    margin-top: 5px;

    color: #9ca3af;

    font-size: 11px;
}

.summary-sub strong {
    color: #6b7280;
    font-weight: 700;
}


/* =========================================================
   SUMMARY COLOR VARIANTS
========================================================= */

.summary-value.gold {
    color: #a18200;
}

.summary-value.in {
    color: #4d7c0f;
}

.summary-value.out {
    color: #b45309;
}

.summary-value.remaining {
    color: #475569;
}

.summary-value.profit {
    color: #a18200;
}


/* =========================================================
   TRANSACTION HEADER
========================================================= */

.transaction-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 17px 20px;

    border-bottom: 1px solid #f0f1f3;
}

.transaction-heading {
    display: flex;
    align-items: center;
    gap: 11px;

    min-width: 0;
}

.transaction-icon {
    width: 38px;
    min-width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    font-size: 17px;
}

.transaction-title-area {
    min-width: 0;
}

.transaction-title {
    margin: 0;

    color: #1f2937;

    font-size: 15px;
    font-weight: 750;
}

.transaction-description {
    margin: 4px 0 0;

    color: #9ca3af;

    font-size: 11.5px;
}

.transaction-count {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-height: 28px;

    padding: 5px 10px;

    background: #fffbea;

    border: 1px solid #f0e4ae;
    border-radius: 20px;

    color: #967900;

    font-size: 10.5px;
    font-weight: 700;

    white-space: nowrap;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper {
    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;
}

.table-wrapper::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.table-wrapper::-webkit-scrollbar-track {
    background: #f8f8f9;
}

.table-wrapper::-webkit-scrollbar-thumb {
    background: #d7d9dd;

    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #c2c5ca;
}


/* =========================================================
   TABLE
========================================================= */

.report-table {
    width: 100%;

    min-width: 900px;

    margin: 0;

    border-collapse: separate;
    border-spacing: 0;

    font-size: 12px;
}


/* =========================================================
   TABLE HEADER
========================================================= */

.report-table thead th {
    padding: 12px 11px;

    background: #fafafa;

    color: #6b7280;

    border-bottom: 1px solid #e3e5e8;
    border-right: 1px solid #eeeeef;

    font-size: 10.5px;

    font-weight: 750;

    letter-spacing: .02em;

    white-space: nowrap;

    vertical-align: middle;
}

.report-table thead th:first-child {
    border-left: 1px solid #eeeeef;
}


/* =========================================================
   TABLE BODY
========================================================= */

.report-table tbody td {
    padding: 11px;

    background: #ffffff;

    color: #4b5563;

    border-bottom: 1px solid #f0f1f3;
    border-right: 1px solid #f0f1f3;

    vertical-align: middle;

    white-space: nowrap;
}

.report-table tbody td:first-child {
    border-left: 1px solid #f0f1f3;
}

.report-table tbody tr {
    transition: background-color .15s ease;
}

.report-table tbody tr:hover td {
    background: #fffdf6;
}


/* =========================================================
   TABLE CELLS
========================================================= */

.number-cell {
    text-align: center;

    color: #6b7280 !important;

    font-variant-numeric: tabular-nums;
}

.date-cell {
    color: #6b7280 !important;

    font-size: 11.5px;
}

.customer-cell {
    color: #374151 !important;

    font-weight: 600;
}

.stock-in {
    color: #4d7c0f !important;

    font-weight: 700;

    text-align: center;
}

.stock-out {
    color: #b45309 !important;

    font-weight: 700;

    text-align: center;
}

.price-cell {
    color: #374151 !important;

    font-weight: 650;

    text-align: right;

    font-variant-numeric: tabular-nums;
}

.discount-cell {
    color: #b45309 !important;

    font-weight: 650;

    text-align: right;

    font-variant-numeric: tabular-nums;
}

.total-cell {
    color: #4d7c0f !important;

    font-weight: 750;

    text-align: right;

    font-variant-numeric: tabular-nums;
}

.profit-cell {
    color: #a18200 !important;

    font-weight: 750;

    text-align: right;

    font-variant-numeric: tabular-nums;
}


/* =========================================================
   QUANTITY BADGES
========================================================= */

.quantity-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 36px;

    padding: 4px 8px;

    border-radius: 6px;

    font-size: 10.5px;
    font-weight: 750;
}

.quantity-in {
    background: #f1f8e9;
    color: #4d7c0f;
}

.quantity-out {
    background: #fff7ed;
    color: #b45309;
}


/* =========================================================
   PRICE BADGE
========================================================= */

.price-main {
    color: #374151;
    font-weight: 650;
}

.price-sub {
    display: block;

    margin-top: 3px;

    color: #a3a8b0;

    font-size: 10px;
}


/* =========================================================
   FOOTER
========================================================= */

.transaction-footer {
    display: flex;

    align-items: center;

    flex-wrap: wrap;

    gap: 3px;

    min-height: 45px;

    padding: 10px 20px;

    background: #fcfcfd;

    border-top: 1px solid #f0f1f3;

    color: #9ca3af;

    font-size: 11.5px;
}

.transaction-footer strong {
    margin: 0 2px;

    color: #6b7280;

    font-weight: 700;
}


/* =========================================================
   EMPTY DATA
========================================================= */

.empty-data {
    padding: 45px 20px !important;

    text-align: center !important;

    color: #a3a8b0 !important;

    background: #ffffff !important;
}

.empty-icon {
    width: 44px;
    height: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 10px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 12px;

    font-size: 19px;
}

.empty-text {
    color: #9ca3af;

    font-size: 11.5px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 991px) {

    .summary-body {
        padding: 17px;
    }

    .info-body {
        padding: 17px;
    }

}


@media (max-width: 767px) {

    .detail-page-header {
        align-items: flex-start;

        flex-direction: column;

        gap: 14px;
    }

    .detail-title {
        font-size: 21px;
    }

    .back-btn {
        width: 100%;
    }

    .info-body,
    .summary-body {
        padding: 15px;
    }

    .transaction-header {
        align-items: flex-start;

        flex-direction: column;

        padding: 15px;
    }

    .transaction-count {
        align-self: flex-start;
    }

    .transaction-footer {
        padding: 10px 15px;
    }

}


@media (max-width: 480px) {

    .detail-title {
        font-size: 20px;
    }

    .detail-breadcrumb {
        font-size: 11.5px;
    }

    .detail-card {
        border-radius: 12px;
    }

    .detail-card-header {
        padding: 15px;
    }

    .card-header-icon {
        width: 36px;
        min-width: 36px;
        height: 36px;
    }

    .card-title {
        font-size: 14px;
    }

    .card-description {
        font-size: 10.5px;
    }

}

</style>


<div class="detail-page">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="detail-page-header">


        <div class="detail-title-area">

            <h3 class="detail-title">
                Detail Laporan Barang
            </h3>

            <div class="detail-breadcrumb">

                Home
                <span>/</span>
                Laporan Barang
                <span>/</span>

                <strong>
                    {{ $barang->nama_barang }}
                </strong>

            </div>

        </div>


        <a
            href="{{ route('laporan.barang.index') }}"
            class="back-btn"
        >

            <span class="back-icon">
                ←
            </span>

            Kembali

        </a>


    </div>



    {{-- =====================================================
         INFORMASI BARANG
    ====================================================== --}}

    <div class="detail-card">


        <div class="detail-card-header">

            <div class="card-header-icon">
                📦
            </div>

            <div class="card-header-text">

                <h5 class="card-title">
                    Informasi Barang
                </h5>

                <p class="card-description">
                    Informasi dasar dari barang yang sedang dilihat.
                </p>

            </div>

        </div>


        <div class="info-body">

            <div class="row g-3">


                {{-- NAMA BARANG --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <span class="info-label">
                            Nama Barang
                        </span>

                        <div class="info-value">
                            {{ $barang->nama_barang }}
                        </div>

                    </div>

                </div>


                {{-- SATUAN --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <span class="info-label">
                            Satuan
                        </span>

                        <div class="info-value">
                            {{ $barang->satuan ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- ISI PER KOLI --}}

                <div class="col-md-4">

                    <div class="info-item">

                        <span class="info-label">
                            Isi Per Koli
                        </span>

                        <div class="info-value">

                            {{ number_format(
                                $barang->pcs_per_koli ?? 0
                            ) }}

                            <small>
                                PCS / Koli
                            </small>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>



    {{-- =====================================================
         RINGKASAN STOK & KEUNTUNGAN
    ====================================================== --}}

    <div class="detail-card">


        <div class="detail-card-header">

            <div class="card-header-icon">
                📊
            </div>

            <div class="card-header-text">

                <h5 class="card-title">
                    Ringkasan Stok & Keuntungan
                </h5>

                <p class="card-description">
                    Ringkasan pergerakan stok dan keuntungan barang.
                </p>

            </div>

        </div>


        <div class="summary-body">

            <div class="row g-3">


                {{-- BARANG MASUK --}}

                <div class="col-md-3 col-6">

                    <div class="summary-item">

                        <span class="summary-label">
                            Barang Masuk
                        </span>

                        <div class="summary-value in">

                            {{ number_format(
                                $totalMasukKoli
                            ) }}

                            Koli

                        </div>

                        <span class="summary-sub">

                            <strong>
                                {{ number_format(
                                    $totalMasukPcs
                                ) }}
                            </strong>

                            PCS

                        </span>

                    </div>

                </div>


                {{-- BARANG KELUAR --}}

                <div class="col-md-3 col-6">

                    <div class="summary-item">

                        <span class="summary-label">
                            Barang Keluar
                        </span>

                        <div class="summary-value out">

                            {{ number_format(
                                $totalKeluarKoli
                            ) }}

                            Koli

                        </div>

                        <span class="summary-sub">

                            <strong>
                                {{ number_format(
                                    $totalKeluarPcs
                                ) }}
                            </strong>

                            PCS

                        </span>

                    </div>

                </div>


                {{-- SISA STOK --}}

                <div class="col-md-3 col-6">

                    <div class="summary-item">

                        <span class="summary-label">
                            Sisa Stok
                        </span>

                        <div class="summary-value remaining">

                            {{ number_format(
                                $sisaKoli
                            ) }}

                            Koli

                        </div>

                        <span class="summary-sub">

                            <strong>
                                {{ number_format(
                                    $sisaPcs
                                ) }}
                            </strong>

                            PCS

                        </span>

                    </div>

                </div>


                {{-- KEUNTUNGAN --}}

                <div class="col-md-3 col-6">

                    <div class="summary-item">

                        <span class="summary-label">
                            Keuntungan
                        </span>

                        <div class="summary-value profit">

                            Rp
                            {{ number_format(
                                $totalKeuntungan,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <span class="summary-sub">
                            Total keuntungan
                        </span>

                    </div>

                </div>


            </div>

        </div>

    </div>



    {{-- =====================================================
         RIWAYAT BARANG MASUK
    ====================================================== --}}

    <div class="detail-card">


        <div class="transaction-header">

            <div class="transaction-heading">

                <div class="transaction-icon">
                    📥
                </div>

                <div class="transaction-title-area">

                    <h5 class="transaction-title">
                        Riwayat Barang Masuk
                    </h5>

                    <p class="transaction-description">

                        Riwayat barang masuk untuk
                        {{ $barang->nama_barang }}.

                    </p>

                </div>

            </div>


            <span class="transaction-count">

                {{ $barangMasuks->count() }}
                Transaksi

            </span>

        </div>



        <div class="table-wrapper">

            <table class="report-table">

                <thead>

                    <tr>

                        <th
                            class="text-center"
                            style="width: 60px;"
                        >
                            No
                        </th>

                        <th>
                            Tanggal Masuk
                        </th>

                        <th>
                            Edisi
                        </th>

                        <th class="text-center">
                            Barang Masuk<br>
                            Koli
                        </th>

                        <th class="text-center">
                            Barang Masuk<br>
                            PCS
                        </th>

                        <th class="text-end">
                            Harga Beli / Koli
                        </th>

                        <th class="text-end">
                            Harga Jual / Koli
                        </th>

                        <th class="text-end">
                            Harga Jual / PCS
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse(
                        $barangMasuks
                        as $index => $masuk
                    )

                        <tr>


                            {{-- NO --}}

                            <td class="number-cell">
                                {{ $index + 1 }}
                            </td>


                            {{-- TANGGAL --}}

                            <td class="date-cell">

                                @if($masuk->tanggal_input)

                                    {{ \Carbon\Carbon::parse(
                                        $masuk->tanggal_input
                                    )->format('d/m/Y') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- EDISI --}}

                            <td>

                                {{ $masuk->edisi ?? '-' }}

                            </td>


                            {{-- KOLI --}}

                            <td class="number-cell">

                                <span class="quantity-badge quantity-in">

                                    {{ number_format(
                                        $masuk->jumlah_koli ?? 0
                                    ) }}

                                </span>

                            </td>


                            {{-- PCS --}}

                            <td class="number-cell stock-in">

                                {{ number_format(
                                    $masuk->jumlah_pcs ?? 0
                                ) }}

                            </td>


                            {{-- HARGA BELI --}}

                            <td class="price-cell">

                                Rp
                                {{ number_format(
                                    $masuk->harga_beli_koli ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            {{-- HARGA JUAL KOLI --}}

                            <td class="price-cell">

                                Rp
                                {{ number_format(
                                    $masuk->harga_jual_koli ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            {{-- HARGA JUAL PCS --}}

                            <td class="price-cell">

                                Rp
                                {{ number_format(
                                    $masuk->harga_jual_pcs ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="empty-data"
                            >

                                <div class="empty-icon">
                                    📥
                                </div>

                                <div class="empty-text">
                                    Belum ada barang masuk
                                    untuk barang ini.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        <div class="transaction-footer">

            Menampilkan

            <strong>
                {{ $barangMasuks->count() }}
            </strong>

            transaksi barang masuk.

            &nbsp;|&nbsp;

            Total masuk:

            <strong>
                {{ number_format($totalMasukKoli) }}
            </strong>

            Koli /

            <strong>
                {{ number_format($totalMasukPcs) }}
            </strong>

            PCS.

        </div>


    </div>



    {{-- =====================================================
         RIWAYAT BARANG KELUAR
    ====================================================== --}}

    <div class="detail-card">


        <div class="transaction-header">

            <div class="transaction-heading">

                <div class="transaction-icon">
                    📤
                </div>

                <div class="transaction-title-area">

                    <h5 class="transaction-title">
                        Riwayat Barang Keluar
                    </h5>

                    <p class="transaction-description">

                        Riwayat transaksi penjualan
                        {{ $barang->nama_barang }}.

                    </p>

                </div>

            </div>


            <span class="transaction-count">

                {{ $penjualanDetails->count() }}
                Transaksi

            </span>

        </div>



        <div class="table-wrapper">

            <table class="report-table">

                <thead>

                    <tr>

                        <th
                            class="text-center"
                            style="width: 60px;"
                        >
                            No
                        </th>

                        <th>
                            Tanggal Keluar
                        </th>

                        <th>
                            Nama Customer
                        </th>

                        <th class="text-center">
                            Barang Keluar<br>
                            Koli
                        </th>

                        <th class="text-center">
                            Barang Keluar<br>
                            PCS
                        </th>

                        <th class="text-end">
                            Total Harga
                        </th>

                        <th class="text-end">
                            Diskon
                        </th>

                        <th class="text-end">
                            Total Setelah Diskon
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse(
                        $penjualanDetails
                        as $index => $detail
                    )

                        @php

                            $penjualan =
                                $detail->penjualan;

                            $tanggalKeluar =
                                $penjualan?->tanggal_penjualan;

                        @endphp


                        <tr>


                            {{-- NO --}}

                            <td class="number-cell">

                                {{ $index + 1 }}

                            </td>


                            {{-- TANGGAL KELUAR --}}

                            <td class="date-cell">

                                @if($tanggalKeluar)

                                    {{ $tanggalKeluar->format(
                                        'd/m/Y'
                                    ) }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- CUSTOMER --}}

                            <td class="customer-cell">

                                {{ $penjualan?->nama_customer ?? '-' }}

                            </td>


                            {{-- KOLI --}}

                            <td class="number-cell">

                                <span class="quantity-badge quantity-out">

                                    {{ number_format(
                                        $detail->jumlah_koli ?? 0
                                    ) }}

                                </span>

                            </td>


                            {{-- PCS --}}

                            <td class="number-cell stock-out">

                                {{ number_format(
                                    $detail->jumlah_pcs ?? 0
                                ) }}

                            </td>


                            {{-- TOTAL HARGA --}}

                            <td class="price-cell">

                                Rp

                                {{ number_format(
                                    $detail->subtotal ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                            {{-- DISKON --}}

                            <td class="discount-cell">

                                {{ number_format(
                                    $detail->laporan_diskon_persen ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}%

                            </td>


                            {{-- TOTAL SETELAH DISKON --}}

                            <td class="total-cell">

                                Rp

                                {{ number_format(
                                    $detail->laporan_total_setelah_diskon ?? 0,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="empty-data"
                            >

                                <div class="empty-icon">
                                    📤
                                </div>

                                <div class="empty-text">
                                    Belum ada barang keluar
                                    untuk barang ini.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        <div class="transaction-footer">

            Menampilkan

            <strong>
                {{ $penjualanDetails->count() }}
            </strong>

            transaksi barang keluar.

            &nbsp;|&nbsp;

            Total keluar:

            <strong>
                {{ number_format($totalKeluarKoli) }}
            </strong>

            Koli /

            <strong>
                {{ number_format($totalKeluarPcs) }}
            </strong>

            PCS.

        </div>


    </div>


</div>

@endsection