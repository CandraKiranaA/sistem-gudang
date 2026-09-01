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
    margin-bottom: 5px;
}

.breadcrumb-text {
    font-size: 13px;
    color: #9ca3af;
}

.report-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
}

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

.report-toolbar {
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    border-bottom: 1px solid #e5e7eb;
}

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
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
}

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
}

.download-btn:hover {
    background: #157347;
    color: #ffffff;
}

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

.stock-in {
    color: #2563eb !important;
    font-weight: 600;
}

.stock-out {
    color: #dc2626 !important;
    font-weight: 600;
}

.stock-sisa {
    color: #475569 !important;
    font-weight: 600;
}

.detail-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 7px 12px;
    border-radius: 6px;
    background: #2563eb;
    color: #ffffff;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
}

.detail-btn:hover {
    background: #1d4ed8;
    color: #ffffff;
}

.action-cell {
    text-align: center;
}

.empty-data {
    padding: 40px 20px !important;
    text-align: center;
    color: #9ca3af !important;
}

.table-footer {
    padding: 13px 20px;
    border-top: 1px solid #e5e7eb;
    background: #fafafa;
    color: #6b7280;
    font-size: 13px;
}

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


<div class="page-header">

    <h3 class="page-title">
        Laporan Barang
    </h3>

    <div class="breadcrumb-text">
        Home / Laporan Barang
    </div>

</div>


{{-- =========================================================
STOK BARANG
========================================================= --}}

<div class="report-card">

    <div class="report-header">

        <h5 class="report-title">
            📦 Stok Barang
        </h5>

        <p class="report-description">
            Rekapitulasi barang masuk, barang keluar, sisa barang, dan keuntungan.
        </p>

    </div>


    <div class="report-toolbar">

        <a
            href="{{ route('laporan.export.excel') }}"
            class="download-btn"
        >
            ⬇ Download Excel
        </a>


        <form
            action="{{ route('laporan.barang.index') }}"
            method="GET"
            class="search-box"
        >

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama barang..."
            >

        </form>

    </div>


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

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>


                        <td class="name-cell">
                            {{ $data['nama_barang'] }}
                        </td>


                        <td class="number-cell">
                            {{ $data['satuan'] ?? '-' }}
                        </td>


                        <td class="number-cell stock-in">
                            {{ number_format($data['barang_masuk_koli'] ?? 0) }}
                        </td>


                        <td class="number-cell stock-in">
                            {{ number_format($data['barang_masuk_pcs'] ?? 0) }}
                        </td>


                        <td class="number-cell stock-out">
                            {{ number_format($data['barang_keluar_koli'] ?? 0) }}
                        </td>


                        <td class="number-cell stock-out">
                            {{ number_format($data['barang_keluar_pcs'] ?? 0) }}
                        </td>


                        <td class="number-cell stock-sisa">
                            {{ number_format($data['sisa_koli'] ?? 0) }}
                        </td>


                        <td class="number-cell stock-sisa">
                            {{ number_format($data['sisa_pcs'] ?? 0) }}
                        </td>


                        <td class="profit-cell">

                            Rp
                            {{ number_format(
                                $data['keuntungan'] ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>


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
========================================================= --}}

<div class="report-card">

    <div class="report-header">

        <h5 class="report-title">
            📤 Barang Keluar
        </h5>

        <p class="report-description">
            Rekapitulasi barang keluar berdasarkan transaksi penjualan.
        </p>

    </div>


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

                        <td class="number-cell">
                            {{ $index + 1 }}
                        </td>


                        <td>

                            @if($detail->penjualan?->tanggal_penjualan)

                                {{ \Carbon\Carbon::parse(
                                    $detail->penjualan->tanggal_penjualan
                                )->format('d/m/Y H:i') }}

                            @else

                                -

                            @endif

                        </td>


                        <td class="name-cell">

                            {{ $detail->penjualan?->nomor_nota ?? '-' }}

                        </td>


                        <td class="name-cell">

                            {{ $detail->penjualan?->nama_customer ?? '-' }}

                        </td>


                        <td class="name-cell">

                            {{ $detail->barang?->nama_barang ?? '-' }}

                        </td>


                        <td class="number-cell">

                            {{ number_format(
                                $detail->jumlah_koli ?? 0
                            ) }}

                        </td>


                        <td class="number-cell">

                            {{ number_format(
                                $detail->jumlah_pcs ?? 0
                            ) }}

                        </td>


                        <td class="price-cell">

                            Rp
                            {{ number_format(
                                $detail->laporan_subtotal ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>


                        <td class="discount-cell">

                            {{ number_format(
                                $detail->laporan_diskon_persen ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}%

                            @if(
                                ($detail->laporan_diskon_nominal ?? 0) > 0
                            )

                                <span class="discount-detail">

                                    - Rp
                                    {{ number_format(
                                        $detail->laporan_diskon_nominal,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            @endif

                        </td>


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


    <div class="table-footer">

        Menampilkan

        <strong>
            {{ $barangKeluar->count() }}
        </strong>

        detail barang keluar.

    </div>

</div>

@endsection