@extends('layouts.app')

@section('title', 'Detail Laporan Barang')

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
        margin-bottom: 4px;
    }

    .breadcrumb-text {
        font-size: 13px;
        color: #9ca3af;
    }


    /* =========================================================
       BACK BUTTON
    ========================================================= */

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 8px 16px;

        background-color: #ffffff;
        border: 1px solid #d1d5db;

        border-radius: 5px;

        color: #4b5563;
        text-decoration: none;

        font-size: 13px;
        font-weight: 500;

        transition: 0.2s;
    }

    .back-btn:hover {
        background-color: #f9fafb;
        color: #374151;
    }


    /* =========================================================
       INFORMATION CARD
    ========================================================= */

    .info-card {
        background-color: #ffffff;

        border: 1px solid #e5e7eb;
        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

        margin-bottom: 25px;

        overflow: hidden;
    }


    .info-card-header {
        padding: 18px 20px;

        border-bottom: 1px solid #e5e7eb;

        background-color: #ffffff;
    }


    .info-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;

        margin: 0;
    }


    .info-card-body {
        padding: 20px;
    }


    /* =========================================================
       INFORMATION ITEM
    ========================================================= */

    .info-item {
        padding: 15px;

        background-color: #f9fafb;

        border: 1px solid #e5e7eb;

        border-radius: 7px;

        height: 100%;
    }


    .info-label {
        display: block;

        font-size: 12px;

        color: #9ca3af;

        margin-bottom: 6px;

        font-weight: 500;
    }


    .info-value {
        font-size: 15px;

        color: #374151;

        font-weight: 600;
    }


    /* =========================================================
       TRANSACTION CARD
    ========================================================= */

    .transaction-card {
        background-color: #ffffff;

        border: 1px solid #e5e7eb;
        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);

        overflow: hidden;
    }


    .transaction-header {
        padding: 18px 20px;

        border-bottom: 1px solid #e5e7eb;

        display: flex;

        justify-content: space-between;

        align-items: center;
    }


    .transaction-title {
        font-size: 16px;

        font-weight: 700;

        color: #1f2937;

        margin: 0;
    }


    .transaction-count {
        font-size: 12px;

        color: #6b7280;

        background-color: #f3f4f6;

        padding: 5px 10px;

        border-radius: 20px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

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
        background-color: #f9fafb;

        color: #374151;

        font-weight: 600;

        border: 1px solid #e5e7eb;

        padding: 12px 10px;

        vertical-align: middle;

        white-space: nowrap;
    }


    .report-table tbody td {
        border: 1px solid #e5e7eb;

        padding: 11px 10px;

        color: #4b5563;

        vertical-align: middle;

        white-space: nowrap;
    }


    .report-table tbody tr:hover {
        background-color: #f9fafb;
    }


    .number-cell {
        text-align: center;
    }


    .nota-cell {
        font-weight: 600;

        color: #374151 !important;
    }


    .customer-cell {
        color: #4b5563 !important;
    }


    .price-cell {
        text-align: right;
    }


    .subtotal-cell {
        text-align: right;

        font-weight: 600;

        color: #16a34a !important;
    }


    /* =========================================================
       EMPTY DATA
    ========================================================= */

    .empty-data {
        padding: 40px 20px !important;

        text-align: center;

        color: #9ca3af !important;
    }


    .empty-icon {
        font-size: 30px;

        margin-bottom: 8px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .content {
            padding: 20px;
        }

        .page-header .d-flex {
            align-items: flex-start !important;
            gap: 15px;
        }

        .info-card-body {
            padding: 15px;
        }

        .transaction-header {
            align-items: flex-start;
            gap: 10px;
        }

    }

</style>


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<div class="page-header">

    <div class="d-flex justify-content-between align-items-center">


        <div>

            <h3 class="page-title">
                Detail Laporan Barang
            </h3>

            <div class="breadcrumb-text">

                Home /
                Laporan Barang /
                {{ $barang->nama_barang }}

            </div>

        </div>


        {{-- KEMBALI --}}

        <a
            href="{{ route('laporan.barang.index') }}"
            class="back-btn"
        >
            ← Kembali
        </a>

    </div>

</div>


{{-- ========================================================= --}}
{{-- INFORMASI BARANG --}}
{{-- ========================================================= --}}

<div class="info-card">


    <div class="info-card-header">

        <h5 class="info-card-title">
            Informasi Barang
        </h5>

    </div>


    <div class="info-card-body">

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
                        {{ $barang->satuan }}
                    </div>

                </div>

            </div>


            {{-- PCS / KOLI --}}

            <div class="col-md-4">

                <div class="info-item">

                    <span class="info-label">
                        Isi Per Koli
                    </span>

                    <div class="info-value">

                        {{ number_format($barang->pcs_per_koli) }}

                        PCS / Koli

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- RIWAYAT BARANG KELUAR --}}
{{-- ========================================================= --}}

<div class="transaction-card">


    {{-- HEADER --}}

    <div class="transaction-header">

        <h5 class="transaction-title">
            Riwayat Barang Keluar
        </h5>


        <span class="transaction-count">

            {{ $penjualanDetails->count() }}
            Transaksi

        </span>

    </div>


    {{-- TABLE --}}

    <div class="table-wrapper">

        <table class="report-table">


            {{-- ================================================= --}}
            {{-- TABLE HEADER --}}
            {{-- ================================================= --}}

            <thead>

                <tr>

                    <th
                        class="text-center"
                        style="width: 60px;"
                    >
                        No
                    </th>


                    <th>
                        Tanggal
                    </th>


                    <th>
                        No Nota
                    </th>


                    <th>
                        Customer
                    </th>


                    <th class="text-center">
                        Koli
                    </th>


                    <th class="text-center">
                        PCS
                    </th>


                    <th class="text-end">
                        Harga
                    </th>


                    <th class="text-end">
                        Subtotal
                    </th>

                </tr>

            </thead>


            {{-- ================================================= --}}
            {{-- TABLE BODY --}}
            {{-- ================================================= --}}

            <tbody>


                @forelse(
                    $penjualanDetails
                    as $index => $detail
                )


                    <tr>


                        {{-- NO --}}

                        <td class="number-cell">

                            {{ $index + 1 }}

                        </td>


                        {{-- TANGGAL --}}

                        <td>

                            @if($detail->penjualan?->tanggal_penjualan)

                                {{
                                    $detail->penjualan
                                        ->tanggal_penjualan
                                        ->format('d/m/Y')
                                }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- NO NOTA --}}

                        <td class="nota-cell">

                            {{
                                $detail->penjualan
                                    ?->nomor_nota
                                ?? '-'
                            }}

                        </td>


                        {{-- CUSTOMER --}}

                        <td class="customer-cell">

                            {{
                                $detail->penjualan
                                    ?->nama_customer
                                ?? '-'
                            }}

                        </td>


                        {{-- KOLI --}}

                        <td class="number-cell">

                            {{
                                number_format(
                                    $detail->jumlah_koli
                                )
                            }}

                        </td>


                        {{-- PCS --}}

                        <td class="number-cell">

                            {{
                                number_format(
                                    $detail->jumlah_pcs
                                )
                            }}

                        </td>


                        {{-- HARGA --}}

                        <td class="price-cell">

                            Rp
                            {{
                                number_format(
                                    $detail->harga,
                                    0,
                                    ',',
                                    '.'
                                )
                            }}

                        </td>


                        {{-- SUBTOTAL --}}

                        <td class="subtotal-cell">

                            Rp
                            {{
                                number_format(
                                    $detail->subtotal,
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
                            colspan="8"
                            class="empty-data"
                        >

                            <div class="empty-icon">
                                📦
                            </div>

                            <div>
                                Belum ada barang keluar.
                            </div>

                        </td>

                    </tr>


                @endforelse


            </tbody>

        </table>

    </div>

</div>

@endsection