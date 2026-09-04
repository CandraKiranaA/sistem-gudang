@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')

<style>

/* =========================================================
   LAPORAN BARANG
   THEME:
   WHITE / SOFT GRAY / CREAM / GOLD
========================================================= */

.laporan-page {
    width: 100%;
}


/* =========================================================
   PAGE HEADER
========================================================= */

.laporan-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.laporan-title-area {
    min-width: 0;
}

.laporan-title {
    margin: 0;
    color: #1f2937;
    font-size: 24px;
    font-weight: 750;
    letter-spacing: -0.4px;
}

.laporan-breadcrumb {
    margin-top: 5px;
    color: #9ca3af;
    font-size: 12.5px;
}

.laporan-breadcrumb span {
    color: #c0a52b;
    font-weight: 600;
}


/* =========================================================
   SUMMARY MINI CARDS
========================================================= */

.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 22px;
}

.summary-card {
    position: relative;
    min-height: 92px;
    padding: 16px 17px;
    overflow: hidden;

    background: #ffffff;
    border: 1px solid #e7e8eb;
    border-radius: 13px;

    box-shadow:
        0 3px 14px rgba(15, 23, 42, 0.035);
}

.summary-card::after {
    content: "";
    position: absolute;

    width: 75px;
    height: 75px;

    right: -30px;
    top: -30px;

    border-radius: 50%;

    background: rgba(212, 167, 0, 0.045);
}

.summary-top {
    display: flex;
    align-items: center;
    gap: 11px;
}

.summary-icon {
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

    position: relative;
    z-index: 1;
}

.summary-label {
    color: #9ca3af;
    font-size: 11px;
    font-weight: 600;
}

.summary-value {
    margin-top: 2px;
    color: #1f2937;
    font-size: 19px;
    font-weight: 750;
    line-height: 1.2;
}

.summary-value.gold {
    color: #a18200;
}


/* =========================================================
   REPORT CARD
========================================================= */

.report-card {
    margin-bottom: 24px;

    background: #ffffff;

    border: 1px solid #e5e7eb;
    border-radius: 14px;

    overflow: hidden;

    box-shadow:
        0 3px 15px rgba(15, 23, 42, 0.035);
}


/* =========================================================
   REPORT HEADER
========================================================= */

.report-header {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 18px 20px;

    border-bottom: 1px solid #f0f1f3;
}

.report-icon {
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

.report-title-area {
    min-width: 0;
}

.report-title {
    margin: 0;

    color: #1f2937;

    font-size: 16px;
    font-weight: 750;
}

.report-description {
    margin: 4px 0 0;

    color: #9ca3af;

    font-size: 12px;
}


/* =========================================================
   TOOLBAR
========================================================= */

.report-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;

    padding: 13px 20px;

    background: #fcfcfd;

    border-bottom: 1px solid #f0f1f3;
}


/* =========================================================
   SEARCH
========================================================= */

.search-form {
    width: 300px;
    max-width: 100%;
}

.search-box {
    position: relative;
}

.search-box-icon {
    position: absolute;

    left: 12px;
    top: 50%;

    transform: translateY(-50%);

    color: #aeb4bd;

    font-size: 13px;

    pointer-events: none;
}

.search-input {
    width: 100%;
    height: 38px;

    padding: 7px 35px 7px 34px;

    background: #ffffff;

    border: 1px solid #dfe2e6;
    border-radius: 8px;

    color: #374151;

    font-size: 12.5px;

    outline: none;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.search-input::placeholder {
    color: #adb3bb;
}

.search-input:hover {
    border-color: #d2d6dc;
}

.search-input:focus {
    border-color: #d4a700;

    box-shadow:
        0 0 0 3px rgba(212, 167, 0, 0.09);
}

.search-clear {
    position: absolute;

    right: 10px;
    top: 50%;

    transform: translateY(-50%);

    color: #c1c5cb;

    font-size: 12px;

    text-decoration: none;
}

.search-clear:hover {
    color: #a18200;
}


/* =========================================================
   DOWNLOAD BUTTON
========================================================= */

.download-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    min-height: 38px;

    padding: 8px 15px;

    background: #fffbea;

    border: 1px solid #eadb91;
    border-radius: 8px;

    color: #967900 !important;

    text-decoration: none;

    font-size: 12px;
    font-weight: 700;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .15s ease,
        box-shadow .2s ease;
}

.download-btn:hover {
    background: #fff6cc;

    border-color: #d4a700;

    color: #806700 !important;

    transform: translateY(-1px);

    box-shadow:
        0 5px 12px rgba(212, 167, 0, 0.09);
}

.download-icon {
    font-size: 14px;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper {
    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;
}

.stock-table-wrapper {
    width: 100%;

    max-height: 430px;

    overflow-y: auto;
    overflow-x: auto;

    -webkit-overflow-scrolling: touch;
}


/* =========================================================
   TABLE SCROLLBAR
========================================================= */

.table-wrapper::-webkit-scrollbar,
.stock-table-wrapper::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.table-wrapper::-webkit-scrollbar-track,
.stock-table-wrapper::-webkit-scrollbar-track {
    background: #f8f8f9;
}

.table-wrapper::-webkit-scrollbar-thumb,
.stock-table-wrapper::-webkit-scrollbar-thumb {
    background: #d7d9dd;
    border-radius: 10px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover,
.stock-table-wrapper::-webkit-scrollbar-thumb:hover {
    background: #c2c5ca;
}


/* =========================================================
   TABLE
========================================================= */

.report-table {
    width: 100%;

    min-width: 1000px;

    margin: 0;

    border-collapse: separate;
    border-spacing: 0;

    font-size: 12px;
}


/* =========================================================
   TABLE HEADER
========================================================= */

.report-table thead th {
    position: sticky;

    top: 0;

    z-index: 5;

    padding: 12px 11px;

    background: #fafafa;

    color: #6b7280;

    border-bottom: 1px solid #e3e5e8;
    border-right: 1px solid #eeeeef;

    font-size: 11px;

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
   TABLE TEXT
========================================================= */

.text-center {
    text-align: center !important;
}

.text-end {
    text-align: right !important;
}

.number-cell {
    text-align: center;

    color: #6b7280 !important;

    font-variant-numeric: tabular-nums;
}

.name-cell {
    color: #374151 !important;

    font-weight: 650;
}

.date-cell {
    color: #6b7280 !important;

    font-size: 11.5px;
}

.nota-cell {
    color: #a18200 !important;

    font-weight: 700;
}

.customer-cell {
    color: #374151 !important;

    font-weight: 600;
}


/* =========================================================
   STOCK VALUES
========================================================= */

.stock-in {
    color: #4d7c0f !important;

    font-weight: 700;
}

.stock-out {
    color: #b45309 !important;

    font-weight: 700;
}

.stock-sisa {
    color: #475569 !important;

    font-weight: 700;
}


/* =========================================================
   STOCK BADGE
========================================================= */

.stock-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 34px;

    padding: 4px 7px;

    border-radius: 6px;

    font-size: 11px;

    font-weight: 700;
}

.stock-badge.in {
    background: #f1f8e9;
    color: #4d7c0f;
}

.stock-badge.out {
    background: #fff7ed;
    color: #b45309;
}

.stock-badge.remaining {
    background: #f5f6f8;
    color: #475569;
}


/* =========================================================
   QUANTITY BADGE
========================================================= */

.quantity-badge {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 35px;

    padding: 4px 7px;

    border-radius: 6px;

    font-size: 11px;

    font-weight: 700;
}

.quantity-koli {
    background: #fffbea;
    color: #a18200;
}

.quantity-pcs {
    background: #f5f6f8;
    color: #64748b;
}


/* =========================================================
   PRICE
========================================================= */

.price-cell {
    text-align: right;

    color: #374151 !important;

    font-weight: 600;

    font-variant-numeric: tabular-nums;
}

.discount-cell {
    text-align: right;

    color: #b45309 !important;

    font-weight: 600;

    font-variant-numeric: tabular-nums;
}

.total-cell {
    text-align: right;

    color: #4d7c0f !important;

    font-weight: 750;

    font-variant-numeric: tabular-nums;
}

.profit-cell {
    text-align: right;

    color: #a18200 !important;

    font-weight: 750;

    font-variant-numeric: tabular-nums;
}


/* =========================================================
   DETAIL BUTTON
========================================================= */

.detail-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 5px;

    min-height: 31px;

    padding: 6px 11px;

    background: #fffbea;

    border: 1px solid #eadb91;

    border-radius: 7px;

    color: #967900 !important;

    text-decoration: none;

    font-size: 11px;

    font-weight: 700;

    transition:
        background-color .2s ease,
        border-color .2s ease,
        color .2s ease,
        transform .15s ease;
}

.detail-btn:hover {
    background: #fff5c7;

    border-color: #d4a700;

    color: #806700 !important;

    transform: translateY(-1px);
}

.action-cell {
    text-align: center;
}


/* =========================================================
   EMPTY DATA
========================================================= */

.empty-data {
    padding: 45px 20px !important;

    text-align: center !important;

    background: #ffffff !important;

    color: #a3a8b0 !important;

    font-size: 12px;
}


/* =========================================================
   FOOTER
========================================================= */

.table-footer {
    display: flex;

    align-items: center;

    min-height: 45px;

    padding: 10px 20px;

    background: #fcfcfd;

    border-top: 1px solid #f0f1f3;

    color: #9ca3af;

    font-size: 11.5px;
}

.table-footer strong {
    margin: 0 4px;

    color: #6b7280;

    font-weight: 700;
}


/* =========================================================
   TABLE SECTION LABEL
========================================================= */

.table-section-label {
    display: flex;

    align-items: center;

    gap: 7px;

    color: #9ca3af;

    font-size: 10px;

    font-weight: 750;

    text-transform: uppercase;

    letter-spacing: .08em;
}

.table-section-dot {
    width: 5px;
    height: 5px;

    border-radius: 50%;

    background: #d4a700;
}


/* =========================================================
   RESPONSIVE 991px
========================================================= */

@media (max-width: 991px) {

    .summary-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}


/* =========================================================
   RESPONSIVE 767px
========================================================= */

@media (max-width: 767px) {

    .laporan-header {
        align-items: flex-start;
    }

    .laporan-title {
        font-size: 21px;
    }

    .summary-grid {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .summary-card {
        min-height: 82px;
    }

    .report-toolbar {
        flex-direction: column;
        align-items: stretch;
    }

    .search-form {
        width: 100%;
    }

    .download-btn {
        width: 100%;
    }

    .stock-table-wrapper {
        max-height: 390px;
    }

}


/* =========================================================
   RESPONSIVE 480px
========================================================= */

@media (max-width: 480px) {

    .laporan-title {
        font-size: 20px;
    }

    .laporan-breadcrumb {
        font-size: 11.5px;
    }

    .report-header {
        padding: 15px;
    }

    .report-icon {
        width: 36px;
        min-width: 36px;
        height: 36px;
        font-size: 16px;
    }

    .report-title {
        font-size: 15px;
    }

    .report-description {
        font-size: 11px;
    }

    .report-toolbar {
        padding: 12px 15px;
    }

    .table-footer {
        padding: 10px 15px;
    }

}

</style>

<div class="laporan-page">


{{-- =====================================================
     PAGE HEADER
====================================================== --}}

<div class="laporan-header">

    <div class="laporan-title-area">

        <h3 class="laporan-title">
            Laporan Barang
        </h3>

        <div class="laporan-breadcrumb">
            Home
            <span>/</span>
            Laporan Barang
        </div>

    </div>

</div>



{{-- =====================================================
     SUMMARY
====================================================== --}}

<div class="summary-grid">


    {{-- TOTAL BARANG --}}

    <div class="summary-card">

        <div class="summary-top">

            <div class="summary-icon">
                📦
            </div>

            <div>

                <div class="summary-label">
                    Total Barang
                </div>

                <div class="summary-value">
                    {{ $laporan->count() }}
                </div>

            </div>

        </div>

    </div>



    {{-- BARANG MASUK --}}

    <div class="summary-card">

        <div class="summary-top">

            <div class="summary-icon">
                📥
            </div>

            <div>

                <div class="summary-label">
                    Total Barang Masuk
                </div>

                <div class="summary-value">
                    {{ number_format(
                        $laporan->sum('barang_masuk_koli')
                    ) }}
                    <small style="font-size:11px;color:#9ca3af;">
                        Koli
                    </small>
                </div>

            </div>

        </div>

    </div>



    {{-- BARANG KELUAR --}}

    <div class="summary-card">

        <div class="summary-top">

            <div class="summary-icon">
                📤
            </div>

            <div>

                <div class="summary-label">
                    Total Barang Keluar
                </div>

                <div class="summary-value gold">
                    {{ number_format(
                        $laporan->sum('barang_keluar_koli')
                    ) }}
                    <small style="font-size:11px;color:#9ca3af;">
                        Koli
                    </small>
                </div>

            </div>

        </div>

    </div>


</div>



{{-- =========================================================
     STOK BARANG
========================================================== --}}

<div class="report-card">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="report-header">

        <div class="report-icon">
            📦
        </div>

        <div class="report-title-area">

            <h5 class="report-title">
                Stok Barang
            </h5>

            <p class="report-description">
                Rekapitulasi stok barang masuk, barang keluar, sisa stok, dan keuntungan.
            </p>

        </div>

    </div>



    {{-- =====================================================
         TOOLBAR
    ====================================================== --}}

    <div class="report-toolbar">


        {{-- DOWNLOAD EXCEL --}}

        <a
            href="{{ route('laporan.export.excel') }}"
            class="download-btn"
        >

            <span class="download-icon">
                ↓
            </span>

            Download Excel

        </a>



        {{-- SEARCH --}}

        <form
            action="{{ route('laporan.barang.index') }}"
            method="GET"
            class="search-form"
        >

            <div class="search-box">

                <span class="search-box-icon">
                    🔍
                </span>

                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    class="search-input"
                    placeholder="Cari nama barang..."
                    autocomplete="off"
                >


                @if(!empty($search))

                    <a
                        href="{{ route('laporan.barang.index') }}"
                        class="search-clear"
                        title="Hapus pencarian"
                    >
                        ✕
                    </a>

                @endif

            </div>

        </form>

    </div>



    {{-- =====================================================
         TABLE STOK
    ====================================================== --}}

    <div class="stock-table-wrapper">

        <table class="report-table">

            <thead>

                <tr>

                    <th class="text-center">
                        No
                    </th>

                    <th>
                        Nama Barang
                    </th>

                    <th class="text-center">
                        Satuan
                    </th>

                    <th class="text-center">
                        Barang Masuk<br>
                        Koli
                    </th>

                    <th class="text-center">
                        Barang Masuk<br>
                        PCS
                    </th>

                    <th class="text-center">
                        Barang Keluar<br>
                        Koli
                    </th>

                    <th class="text-center">
                        Barang Keluar<br>
                        PCS
                    </th>

                    <th class="text-center">
                        Sisa<br>
                        Koli
                    </th>

                    <th class="text-center">
                        Sisa<br>
                        PCS
                    </th>

                    <th class="text-end">
                        Keuntungan
                    </th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($laporan as $index => $data)

                    <tr>


                        {{-- NO --}}

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>



                        {{-- NAMA BARANG --}}

                        <td class="name-cell">
                            {{ $data['nama_barang'] ?? '-' }}
                        </td>



                        {{-- SATUAN --}}

                        <td class="number-cell">
                            {{ $data['satuan'] ?? '-' }}
                        </td>



                        {{-- BARANG MASUK KOLI --}}

                        <td class="number-cell">

                            <span class="stock-badge in">
                                {{ number_format(
                                    $data['barang_masuk_koli'] ?? 0
                                ) }}
                            </span>

                        </td>



                        {{-- BARANG MASUK PCS --}}

                        <td class="number-cell stock-in">
                            {{ number_format(
                                $data['barang_masuk_pcs'] ?? 0
                            ) }}
                        </td>



                        {{-- BARANG KELUAR KOLI --}}

                        <td class="number-cell">

                            <span class="stock-badge out">
                                {{ number_format(
                                    $data['barang_keluar_koli'] ?? 0
                                ) }}
                            </span>

                        </td>



                        {{-- BARANG KELUAR PCS --}}

                        <td class="number-cell stock-out">
                            {{ number_format(
                                $data['barang_keluar_pcs'] ?? 0
                            ) }}
                        </td>



                        {{-- SISA KOLI --}}

                        <td class="number-cell">

                            <span class="stock-badge remaining">
                                {{ number_format(
                                    $data['sisa_koli'] ?? 0
                                ) }}
                            </span>

                        </td>



                        {{-- SISA PCS --}}

                        <td class="number-cell stock-sisa">
                            {{ number_format(
                                $data['sisa_pcs'] ?? 0
                            ) }}
                        </td>



                        {{-- KEUNTUNGAN --}}

                        <td class="profit-cell">

                            Rp
                            {{ number_format(
                                $data['keuntungan'] ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>



                        {{-- AKSI --}}

                        <td class="action-cell">

                            <a
                                href="{{ route(
                                    'laporan.barang.show',
                                    $data['id']
                                ) }}"
                                class="detail-btn"
                            >
                                👁 Detail
                            </a>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="11"
                            class="empty-data"
                        >

                            📦 Belum ada data stok barang.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="table-footer">

        Menampilkan

        <strong>
            {{ $laporan->count() }}
        </strong>

        barang.

    </div>

</div>



{{-- =========================================================
     BARANG KELUAR
========================================================== --}}

<div class="report-card">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="report-header">

        <div class="report-icon">
            📤
        </div>

        <div class="report-title-area">

            <h5 class="report-title">
                Barang Keluar
            </h5>

            <p class="report-description">
                Riwayat barang keluar berdasarkan transaksi penjualan.
            </p>

        </div>

    </div>



    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="table-wrapper">

        <table class="report-table">

            <thead>

                <tr>

                    <th class="text-center">
                        No
                    </th>

                    <th>
                        Tanggal Keluar
                    </th>

                    <th>
                        No Nota
                    </th>

                    <th>
                        Nama Customer
                    </th>

                    <th>
                        Barang
                    </th>

                    <th class="text-center">
                        Koli
                    </th>

                    <th class="text-center">
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

                @forelse($barangKeluar as $index => $detail)

                    <tr>


                        {{-- NO --}}

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>



                        {{-- TANGGAL --}}

                        <td class="date-cell">

                            @if($detail->penjualan?->tanggal_penjualan)

                                {{ \Carbon\Carbon::parse(
                                    $detail->penjualan->tanggal_penjualan
                                )->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </td>



                        {{-- NO NOTA --}}

                        <td class="nota-cell">
                            {{ $detail->penjualan?->nomor_nota ?? '-' }}
                        </td>



                        {{-- CUSTOMER --}}

                        <td class="customer-cell">
                            {{ $detail->penjualan?->nama_customer ?? '-' }}
                        </td>



                        {{-- BARANG --}}

                        <td class="name-cell">
                            {{ $detail->barang?->nama_barang ?? '-' }}
                        </td>



                        {{-- KOLI --}}

                        <td class="number-cell">

                            <span class="quantity-badge quantity-koli">

                                {{ number_format(
                                    $detail->jumlah_koli ?? 0
                                ) }}

                            </span>

                        </td>



                        {{-- PCS --}}

                        <td class="number-cell">

                            <span class="quantity-badge quantity-pcs">

                                {{ number_format(
                                    $detail->jumlah_pcs ?? 0
                                ) }}

                            </span>

                        </td>



                        {{-- TOTAL HARGA --}}

                        <td class="price-cell">

                            Rp
                            {{ number_format(
                                $detail->laporan_subtotal ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>



                        {{-- DISKON --}}

                        <td class="discount-cell">

                            Rp
                            {{ number_format(
                                $detail->laporan_diskon_nominal ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

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
                            colspan="10"
                            class="empty-data"
                        >

                            📤 Belum ada barang keluar.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="table-footer">

        Menampilkan

        <strong>
            {{ $barangKeluar->count() }}
        </strong>

        detail barang keluar.

    </div>

</div>

</div>

@endsection
