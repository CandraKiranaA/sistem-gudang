@extends('layouts.app')

@section('title', 'Laporan Barang')

@section('content')

<style>

    .page-header {
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .breadcrumb-text {
        font-size: 13px;
        color: #9ca3af;
    }


    .report-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
        overflow: hidden;
        margin-bottom: 25px;
    }


    .report-header {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
    }


    .report-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }


    .report-description {
        font-size: 13px;
        color: #9ca3af;
        margin: 0;
    }


    .report-toolbar {
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        border-bottom: 1px solid #e5e7eb;
    }


    .search-box {
        width: 260px;
    }


    .search-box input {
        width: 100%;
        height: 40px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
    }


    .search-box input:focus {
        border-color: #6366f1;
        box-shadow:
            0 0 0 3px
            rgba(99,102,241,.08);
    }


    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 9px 15px;

        border-radius: 7px;

        background: #198754;
        color: #fff;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        transition: .2s;
    }


    .download-btn:hover {
        background: #157347;
        color: #fff;
        transform: translateY(-1px);
    }


    .table-wrapper {
        overflow-x: auto;
    }


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

        padding: 12px 10px;

        color: #475569;

        vertical-align: middle;

        white-space: nowrap;
    }


    .report-table tbody tr:hover {
        background: #f8fafc;
    }


    .group-header {
        text-align: center;
        background: #f1f5f9 !important;
    }


    .number-cell {
        text-align: center;
    }


    .name-cell {
        font-weight: 600;
        color: #334155 !important;
    }


    .price-cell {
        text-align: right;
        font-weight: 600;
        color: #334155 !important;
    }


    .discount-cell {
        text-align: right;
        color: #dc2626 !important;
        font-weight: 600;
    }


    .total-cell {
        text-align: right;
        color: #16a34a !important;
        font-weight: 700;
    }


    .detail-btn {
        width: 32px;
        height: 32px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        background: #0ea5e9;
        color: #fff;

        border-radius: 6px;

        text-decoration: none;

        transition: .2s;
    }


    .detail-btn:hover {
        background: #0284c7;
        color: #fff;
    }


    .empty-data {
        padding: 40px !important;

        text-align: center;

        color: #9ca3af !important;
    }


    .table-footer {
        padding: 13px 20px;

        border-top: 1px solid #e5e7eb;

        color: #6b7280;

        font-size: 13px;
    }


    .section-gap {
        margin-top: 30px;
    }


    @media (max-width: 768px) {

        .search-box {
            width: 100%;
        }

        .download-btn {
            width: 100%;
            justify-content: center;
        }

    }

</style>


{{-- ========================================================= --}}
{{-- PAGE HEADER --}}
{{-- ========================================================= --}}

<div class="page-header">

    <div>

        <h3 class="page-title">
            Laporan Barang
        </h3>

        <div class="breadcrumb-text">
            Home / Laporan Barang
        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- TABEL 1 : STOK BARANG --}}
{{-- ========================================================= --}}

<div class="report-card">


    {{-- HEADER --}}

    <div class="report-header">

        <h5 class="report-title">
            📦 Stok Barang
        </h5>

        <p class="report-description">
            Rekap jumlah barang masuk dan barang keluar.
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
                value="{{ $search }}"
                placeholder="Cari barang atau customer..."
            >

        </form>

    </div>


    {{-- TABLE --}}

    <div class="table-wrapper">

        <table class="report-table">

            <thead>

                <tr>

                    <th
                        rowspan="2"
                        class="text-center"
                    >
                        No
                    </th>

                    <th
                        rowspan="2"
                    >
                        Nama Barang
                    </th>

                    <th
                        rowspan="2"
                        class="text-center"
                    >
                        Satuan
                    </th>

                    <th
                        colspan="2"
                        class="group-header"
                    >
                        Barang Masuk
                    </th>

                    <th
                        colspan="2"
                        class="group-header"
                    >
                        Barang Keluar
                    </th>

                    <th
                        rowspan="2"
                        class="text-center"
                    >
                        Detail
                    </th>

                </tr>


                <tr>

                    <th class="text-center">
                        Koli
                    </th>

                    <th class="text-center">
                        PCS
                    </th>

                    <th class="text-center">
                        Koli
                    </th>

                    <th class="text-center">
                        PCS
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($laporan as $index => $data)

                    <tr>

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>


                        <td class="name-cell">
                            {{ $data['nama_barang'] }}
                        </td>


                        <td class="number-cell">
                            {{ $data['satuan'] }}
                        </td>


                        {{-- BARANG MASUK --}}

                        <td class="number-cell">
                            {{ number_format(
                                $data['barang_masuk_koli']
                            ) }}
                        </td>

                        <td class="number-cell">
                            {{ number_format(
                                $data['barang_masuk_pcs']
                            ) }}
                        </td>


                        {{-- BARANG KELUAR --}}

                        <td class="number-cell">
                            {{ number_format(
                                $data['barang_keluar_koli']
                            ) }}
                        </td>

                        <td class="number-cell">
                            {{ number_format(
                                $data['barang_keluar_pcs']
                            ) }}
                        </td>


                        {{-- DETAIL --}}

                        <td class="text-center">

                            <a
                                href="{{ route(
                                    'laporan.barang.show',
                                    $data['id']
                                ) }}"
                                class="detail-btn"
                                title="Detail"
                            >
                                👁
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="empty-data"
                        >
                            📦 Belum ada data stok barang.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <div class="table-footer">

        Menampilkan
        <strong>
            {{ $laporan->count() }}
        </strong>
        barang.

    </div>

</div>



{{-- ========================================================= --}}
{{-- TABEL 2 : BARANG KELUAR --}}
{{-- ========================================================= --}}

<div class="report-card section-gap">


    {{-- HEADER --}}

    <div class="report-header">

        <h5 class="report-title">
            📤 Barang Keluar
        </h5>

        <p class="report-description">
            Rekap barang yang keluar berdasarkan transaksi nota.
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

                @forelse(
                    $barangKeluar
                    as $index => $detail
                )

                    <tr>


                        {{-- NO --}}

                        <td class="number-cell">

                            {{ $index + 1 }}

                        </td>


                        {{-- TANGGAL --}}

                        <td>

                            @if(
                                $detail->penjualan
                                ?->tanggal_penjualan
                            )

                                {{
                                    $detail->penjualan
                                        ->tanggal_penjualan
                                        ->format('d/m/Y')
                                }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- CUSTOMER --}}

                        <td class="name-cell">

                            {{
                                $detail->penjualan
                                    ?->nama_customer
                                ?? '-'
                            }}

                        </td>


                        {{-- BARANG --}}

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
                                    $detail->jumlah_koli
                                    ?? 0
                                )
                            }}

                        </td>


                        {{-- PCS --}}

                        <td class="number-cell">

                            {{
                                number_format(
                                    $detail->jumlah_pcs
                                    ?? 0
                                )
                            }}

                        </td>


                        {{-- TOTAL HARGA --}}

                        <td class="price-cell">

                            Rp
                            {{
                                number_format(
                                    $detail->penjualan
                                        ?->total_harga
                                    ?? 0,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                        </td>


                        {{-- DISKON --}}

                        <td class="discount-cell">

                            Rp
                            {{
                                number_format(
                                    $detail->penjualan
                                        ?->diskon
                                    ?? 0,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                        </td>


                        {{-- TOTAL SETELAH DISKON --}}

                        <td class="total-cell">

                            Rp
                            {{
                                number_format(
                                    $detail->penjualan
                                        ?->total_setelah_diskon
                                    ?? 0,
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


    <div class="table-footer">

        Menampilkan
        <strong>
            {{ $barangKeluar->count() }}
        </strong>
        transaksi barang keluar.

    </div>

</div>

@endsection