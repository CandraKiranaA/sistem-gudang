@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')

<style>

/* =========================================================
   PAGE HEADER
========================================================= */

.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 5px;
}

.breadcrumb-text {
    font-size: 13px;
    color: #9ca3af;
}


/* =========================================================
   REPORT CARD
========================================================= */

.report-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
}


/* =========================================================
   REPORT HEADER
========================================================= */

.report-header {
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.report-title {
    font-size: 18px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.report-description {
    font-size: 13px;
    color: #9ca3af;
    margin: 5px 0 0;
}


/* =========================================================
   TOOLBAR
========================================================= */

.report-toolbar {
    padding: 15px 20px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    gap: 12px;
    flex-wrap: wrap;

    border-bottom: 1px solid #e5e7eb;
    background: #ffffff;
}


/* =========================================================
   SEARCH
========================================================= */

.search-box {
    width: 280px;
}

.search-box input {
    width: 100%;
    height: 38px;

    padding: 8px 12px;

    border: 1px solid #d1d5db;
    border-radius: 6px;

    font-size: 13px;

    outline: none;
}

.search-box input:focus {
    border-color: #6366f1;

    box-shadow:
        0 0 0 3px
        rgba(99, 102, 241, .08);
}


/* =========================================================
   DOWNLOAD BUTTON
========================================================= */

.download-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 15px;

    border-radius: 6px;

    background: #198754;
    color: #ffffff;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition: .2s;
}

.download-btn:hover {
    background: #157347;
    color: #ffffff;
}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}


/* =========================================================
   TABLE
========================================================= */

.report-table {
    width: 100%;
    margin: 0;

    border-collapse: collapse;

    font-size: 13px;
}

.report-table thead th {
    background: #f8fafc;

    color: #475569;

    font-weight: 700;

    border: 1px solid #e5e7eb;

    padding: 12px 10px;

    white-space: nowrap;

    vertical-align: middle;
}

.report-table tbody td {
    border: 1px solid #e5e7eb;

    padding: 11px 10px;

    color: #475569;

    vertical-align: middle;

    white-space: nowrap;
}

.report-table tbody tr:hover {
    background: #f8fafc;
}


/* =========================================================
   CELL
========================================================= */

.text-center {
    text-align: center !important;
}

.text-end {
    text-align: right !important;
}

.name-cell {
    font-weight: 600;
    color: #334155 !important;
}

.number-cell {
    text-align: center;
}

.price-cell {
    text-align: right;

    font-weight: 600;

    color: #334155 !important;
}

.discount-cell {
    text-align: right;

    font-weight: 600;

    color: #dc2626 !important;
}

.discount-detail {
    display: block;

    margin-top: 2px;

    font-size: 11px;

    color: #9ca3af;

    font-weight: 400;
}

.total-cell {
    text-align: right;

    font-weight: 700;

    color: #16a34a !important;
}

.profit-cell {
    text-align: right;

    font-weight: 700;

    color: #16a34a !important;
}


/* =========================================================
   STOCK COLORS
========================================================= */

.stock-in {
    color: #2563eb;
    font-weight: 600;
}

.stock-out {
    color: #dc2626;
    font-weight: 600;
}

.stock-sisa {
    color: #475569;
    font-weight: 600;
}


/* =========================================================
   EMPTY DATA
========================================================= */

.empty-data {
    padding: 40px 20px !important;

    text-align: center;

    color: #9ca3af !important;
}


/* =========================================================
   TABLE FOOTER
========================================================= */

.table-footer {
    padding: 13px 20px;

    border-top: 1px solid #e5e7eb;

    background: #fafafa;

    color: #6b7280;

    font-size: 13px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .page-title {
        font-size: 21px;
    }

    .report-toolbar {
        align-items: stretch;
    }

    .search-box {
        width: 100%;
    }

    .download-btn {
        width: 100%;
        justify-content: center;
    }

}

</style>


{{-- =========================================================
   PAGE HEADER
========================================================= --}}

<div class="page-header">

    <h3 class="page-title">
        Laporan Barang
    </h3>

    <div class="breadcrumb-text">
        Home / Laporan Barang
    </div>

</div>



{{-- =========================================================
   TABEL 1 : STOK BARANG
========================================================= --}}

<div class="report-card">

    {{-- HEADER --}}

    <div class="report-header">

        <h5 class="report-title">
            📦 Stok Barang
        </h5>

        <p class="report-description">
            Rekapitulasi barang masuk, barang keluar, sisa barang, dan keuntungan.
        </p>

    </div>


    {{-- TOOLBAR --}}

    <div class="report-toolbar">

        {{-- DOWNLOAD --}}

        <a
            href="{{ route('laporan.export.excel') }}"
            class="download-btn"
        >
            ⬇ Download Excel
        </a>


        {{-- SEARCH --}}

        <form
            action="{{ route('laporan.barang.index') }}"
            method="GET"
            class="search-box"
        >

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari barang atau customer..."
            >

        </form>

    </div>


    {{-- TABLE --}}

    <div class="table-wrapper">

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
                        (Koli)
                    </th>

                    <th class="text-center">
                        Barang Masuk<br>
                        (PCS)
                    </th>

                    <th class="text-center">
                        Barang Keluar<br>
                        (Koli)
                    </th>

                    <th class="text-center">
                        Barang Keluar<br>
                        (PCS)
                    </th>

                    <th class="text-center">
                        Sisa Barang<br>
                        (Koli)
                    </th>

                    <th class="text-center">
                        Sisa Barang<br>
                        (PCS)
                    </th>

                    <th class="text-center">
                        Keuntungan
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($laporan as $index => $data)

                    @php

                        $barangMasukKoli =
                            $data['barang_masuk_koli'] ?? 0;

                        $barangMasukPcs =
                            $data['barang_masuk_pcs'] ?? 0;

                        $barangKeluarKoli =
                            $data['barang_keluar_koli'] ?? 0;

                        $barangKeluarPcs =
                            $data['barang_keluar_pcs'] ?? 0;

                        $sisaKoli =
                            $barangMasukKoli -
                            $barangKeluarKoli;

                        $sisaPcs =
                            $barangMasukPcs -
                            $barangKeluarPcs;

                        $keuntungan =
                            $data['keuntungan'] ?? 0;

                    @endphp


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

                        <td class="number-cell stock-in">
                            {{ number_format($barangMasukKoli) }}
                        </td>


                        {{-- BARANG MASUK PCS --}}

                        <td class="number-cell stock-in">
                            {{ number_format($barangMasukPcs) }}
                        </td>


                        {{-- BARANG KELUAR KOLI --}}

                        <td class="number-cell stock-out">
                            {{ number_format($barangKeluarKoli) }}
                        </td>


                        {{-- BARANG KELUAR PCS --}}

                        <td class="number-cell stock-out">
                            {{ number_format($barangKeluarPcs) }}
                        </td>


                        {{-- SISA KOLI --}}

                        <td class="number-cell stock-sisa">
                            {{ number_format($sisaKoli) }}
                        </td>


                        {{-- SISA PCS --}}

                        <td class="number-cell stock-sisa">
                            {{ number_format($sisaPcs) }}
                        </td>


                        {{-- KEUNTUNGAN --}}

                        <td class="profit-cell">

                            Rp
                            {{ number_format(
                                $keuntungan,
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
                            📦 Belum ada data stok barang.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}

    <div class="table-footer">

        Menampilkan

        <strong>
            {{ $laporan->count() }}
        </strong>

        barang.

    </div>

</div>



{{-- =========================================================
   TABEL 2 : BARANG KELUAR
========================================================= --}}

<div class="report-card">

    {{-- HEADER --}}

    <div class="report-header">

        <h5 class="report-title">
            📤 Barang Keluar
        </h5>

        <p class="report-description">
            Rekapitulasi barang keluar berdasarkan transaksi penjualan.
        </p>

    </div>


    {{-- TABLE --}}

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
                        Nama Customer
                    </th>

                    <th>
                        Barang Keluar
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

                    @php

                        /*
                        |--------------------------------------------------------------------------
                        | DATA PENJUALAN
                        |--------------------------------------------------------------------------
                        */

                        $penjualan =
                            $detail->penjualan;


                        /*
                        |--------------------------------------------------------------------------
                        | TOTAL HARGA
                        |--------------------------------------------------------------------------
                        |
                        | Menggunakan subtotal dari masing-masing
                        | detail barang.
                        |
                        */

                        $totalHarga =
                            (float) (
                                $detail->subtotal ?? 0
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | DISKON
                        |--------------------------------------------------------------------------
                        |
                        | Diskon pada tabel penjualan disimpan
                        | dalam bentuk PERSENTASE.
                        |
                        */

                        $diskonPersen =
                            (float) (
                                $penjualan?->diskon ?? 0
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | NOMINAL DISKON
                        |--------------------------------------------------------------------------
                        */

                        $jumlahDiskon =
                            $totalHarga *
                            ($diskonPersen / 100);


                        /*
                        |--------------------------------------------------------------------------
                        | TOTAL SETELAH DISKON
                        |--------------------------------------------------------------------------
                        */

                        $totalSetelahDiskon =
                            $totalHarga -
                            $jumlahDiskon;

                    @endphp


                    <tr>

                        {{-- NO --}}

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>


                        {{-- TANGGAL KELUAR --}}

                        <td>

                            @if($penjualan?->tanggal_penjualan)

                                {{
                                    $penjualan
                                        ->tanggal_penjualan
                                        ->timezone('Asia/Jakarta')
                                        ->format('d/m/Y H:i')
                                }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- NAMA CUSTOMER --}}

                        <td class="name-cell">

                            {{
                                $penjualan?->nama_customer
                                ?? '-'
                            }}

                        </td>


                        {{-- BARANG KELUAR --}}

                        <td class="name-cell">

                            {{
                                $detail->barang
                                    ?->nama_barang
                                ?? '-'
                            }}

                        </td>


                        {{-- KOLI --}}

                        <td class="number-cell">

                            {{
                                number_format(
                                    $detail->jumlah_koli ?? 0
                                )
                            }}

                        </td>


                        {{-- PCS --}}

                        <td class="number-cell">

                            {{
                                number_format(
                                    $detail->jumlah_pcs ?? 0
                                )
                            }}

                        </td>


                        {{-- TOTAL HARGA --}}

                        <td class="price-cell">

                            Rp
                            {{
                                number_format(
                                    $totalHarga,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                        </td>


                        {{-- DISKON --}}

                        <td class="discount-cell">

                            {{ number_format(
                                $diskonPersen,
                                0,
                                ',',
                                '.'
                            ) }}%

                            <span class="discount-detail">

                                - Rp
                                {{
                                    number_format(
                                        $jumlahDiskon,
                                        0,
                                        ',',
                                        '.'
                                    )
                                }}

                            </span>

                        </td>


                        {{-- TOTAL SETELAH DISKON --}}

                        <td class="total-cell">

                            Rp
                            {{
                                number_format(
                                    $totalSetelahDiskon,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="9"
                            class="empty-data"
                        >

                            📤 Belum ada barang keluar.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}

    <div class="table-footer">

        Menampilkan

        <strong>
            {{ $barangKeluar->count() }}
        </strong>

        detail barang keluar.

    </div>

</div>

@endsection