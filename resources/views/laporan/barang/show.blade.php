@extends('layouts.app')

@section('title', 'Detail Laporan Barang')

@section('content')

<style>

/* =========================================================
   GENERAL
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
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 7px;
    color: #4b5563;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: .2s;
}

.back-btn:hover {
    background: #f9fafb;
    color: #374151;
}


/* =========================================================
   CARD
========================================================= */

.info-card,
.transaction-card,
.summary-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
    margin-bottom: 25px;
    overflow: hidden;
}


/* =========================================================
   CARD HEADER
========================================================= */

.info-card-header,
.transaction-header {
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.transaction-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.card-title,
.transaction-title {
    font-size: 16px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.transaction-description {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 4px;
    margin-bottom: 0;
}


/* =========================================================
   INFORMATION
========================================================= */

.info-card-body {
    padding: 20px;
}

.info-item {
    padding: 15px;
    background: #f9fafb;
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
   SUMMARY
========================================================= */

.summary-body {
    padding: 20px;
}

.summary-item {
    padding: 18px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    border-radius: 8px;
    height: 100%;
}

.summary-label {
    display: block;
    font-size: 12px;
    color: #9ca3af;
    margin-bottom: 6px;
}

.summary-value {
    font-size: 18px;
    font-weight: 700;
    color: #374151;
}

.summary-value.blue {
    color: #2563eb;
}

.summary-value.red {
    color: #dc2626;
}

.summary-value.green {
    color: #16a34a;
}


/* =========================================================
   TABLE
========================================================= */

.table-wrapper {
    width: 100%;
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
    background: #f9fafb;
}


/* =========================================================
   CELL
========================================================= */

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
    color: #dc2626 !important;
    font-weight: 600;
}

.total-cell {
    text-align: right;
    color: #16a34a !important;
    font-weight: 700;
}

.profit-cell {
    text-align: right;
    color: #16a34a !important;
    font-weight: 700;
}

.stock-in {
    color: #2563eb;
    font-weight: 600;
}

.stock-out {
    color: #dc2626;
    font-weight: 600;
}


/* =========================================================
   COUNT
========================================================= */

.transaction-count {
    font-size: 12px;
    color: #6b7280;
    background: #f3f4f6;
    padding: 6px 11px;
    border-radius: 20px;
}


/* =========================================================
   FOOTER
========================================================= */

.transaction-footer {
    padding: 13px 20px;
    border-top: 1px solid #e5e7eb;
    color: #6b7280;
    font-size: 13px;
}


/* =========================================================
   EMPTY
========================================================= */

.empty-data {
    padding: 45px 20px !important;
    text-align: center;
    color: #9ca3af !important;
}

.empty-icon {
    font-size: 32px;
    margin-bottom: 8px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .info-card-body,
    .summary-body {
        padding: 15px;
    }

    .transaction-header {
        align-items: flex-start;
    }

}

</style>

{{-- =========================================================
HEADER
========================================================= --}}

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


    <a
        href="{{ route('laporan.barang.index') }}"
        class="back-btn"
    >
        ← Kembali
    </a>

</div>


</div>

{{-- =========================================================
INFORMASI BARANG
========================================================= --}}

<div class="info-card">


<div class="info-card-header">

    <h5 class="card-title">
        📦 Informasi Barang
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


        {{-- PCS PER KOLI --}}

        <div class="col-md-4">

            <div class="info-item">

                <span class="info-label">
                    Isi Per Koli
                </span>

                <div class="info-value">

                    {{ number_format(
                        $barang->pcs_per_koli ?? 0
                    ) }}

                    PCS / Koli

                </div>

            </div>

        </div>

    </div>

</div>


</div>

{{-- =========================================================
RINGKASAN
========================================================= --}}

<div class="summary-card">


<div class="info-card-header">

    <h5 class="card-title">
        📊 Ringkasan Stok & Keuntungan
    </h5>

</div>


<div class="summary-body">

    <div class="row g-3">


        {{-- BARANG MASUK --}}

        <div class="col-md-3">

            <div class="summary-item">

                <span class="summary-label">
                    Barang Masuk
                </span>

                <div class="summary-value blue">

                    {{ number_format($totalMasukKoli) }}
                    Koli

                </div>

                <small class="text-muted">

                    {{ number_format($totalMasukPcs) }}
                    PCS

                </small>

            </div>

        </div>


        {{-- BARANG KELUAR --}}

        <div class="col-md-3">

            <div class="summary-item">

                <span class="summary-label">
                    Barang Keluar
                </span>

                <div class="summary-value red">

                    {{ number_format($totalKeluarKoli) }}
                    Koli

                </div>

                <small class="text-muted">

                    {{ number_format($totalKeluarPcs) }}
                    PCS

                </small>

            </div>

        </div>


        {{-- SISA STOK --}}

        <div class="col-md-3">

            <div class="summary-item">

                <span class="summary-label">
                    Sisa Stok
                </span>

                <div class="summary-value">

                    {{ number_format($sisaKoli) }}
                    Koli

                </div>

                <small class="text-muted">

                    {{ number_format($sisaPcs) }}
                    PCS

                </small>

            </div>

        </div>


        {{-- KEUNTUNGAN --}}

        <div class="col-md-3">

            <div class="summary-item">

                <span class="summary-label">
                    Keuntungan
                </span>

                <div class="summary-value green">

                    Rp
                    {{ number_format(
                        $totalKeuntungan,
                        0,
                        ',',
                        '.'
                    ) }}

                </div>

            </div>

        </div>

    </div>

</div>


</div>

{{-- =========================================================
RIWAYAT BARANG MASUK
========================================================= --}}

<div class="transaction-card">

<div class="transaction-header">

    <div>

        <h5 class="transaction-title">
            📥 Riwayat Barang Masuk
        </h5>

        <p class="transaction-description">

            Riwayat barang masuk untuk
            {{ $barang->nama_barang }}.

        </p>

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
                    (Koli)
                </th>

                <th class="text-center">
                    Barang Masuk<br>
                    (PCS)
                </th>

                <th class="text-end">
                    Harga Beli
                </th>

                <th class="text-end">
                    Harga Koli
                </th>

                <th class="text-end">
                    Harga PCS
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


                    {{-- TANGGAL MASUK --}}

                    <td>

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


                    {{-- BARANG MASUK KOLI --}}

                    <td class="number-cell stock-in">

                        {{ number_format(
                            $masuk->jumlah_koli ?? 0
                        ) }}

                    </td>


                    {{-- BARANG MASUK PCS --}}

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

                        <div>
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

{{-- =========================================================
RIWAYAT BARANG KELUAR
========================================================= --}}

<div class="transaction-card">


<div class="transaction-header">

    <div>

        <h5 class="transaction-title">
            📤 Riwayat Barang Keluar
        </h5>

        <p class="transaction-description">

            Riwayat transaksi penjualan
            {{ $barang->nama_barang }}.

        </p>

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
                    Barang Keluar (Koli)
                </th>

                <th class="text-center">
                    Barang Keluar (PCS)
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

                    $penjualan = $detail->penjualan;

                    $tanggalKeluar =
                        $penjualan?->tanggal_penjualan;

                @endphp


                <tr>

                    {{-- NO --}}

                    <td class="number-cell">

                        {{ $index + 1 }}

                    </td>


                    {{-- TANGGAL KELUAR --}}

                    <td>

                        @if($tanggalKeluar)

                            {{ $tanggalKeluar->format('d/m/Y') }}

                        @else

                            -

                        @endif

                    </td>


                    {{-- CUSTOMER --}}

                    <td>

                        {{ $penjualan?->nama_customer ?? '-' }}

                    </td>


                    {{-- KOLI --}}

                    <td class="number-cell stock-out">

                        {{ number_format(
                            $detail->jumlah_koli ?? 0
                        ) }}

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

                        <div>
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

@endsection
