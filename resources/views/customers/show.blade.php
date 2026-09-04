@extends('layouts.app')

@section('title', 'Detail Customer')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="page-header mb-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

            <div>

                <div class="d-flex align-items-center gap-3">

                    <div class="page-icon">
                        👥
                    </div>

                    <div>

                        <h3 class="page-title mb-1">
                            {{ $nama_customer }}
                        </h3>

                        <div class="breadcrumb-text">
                            Home
                            <span class="mx-1">/</span>
                            Laporan Customer
                            <span class="mx-1">/</span>
                            <span class="current">
                                Detail Customer
                            </span>
                        </div>

                    </div>

                </div>

                <p class="page-description mb-0 mt-2">
                    Riwayat transaksi Stock Out customer
                </p>

            </div>


            <a
                href="{{ route('customers.index') }}"
                class="btn btn-back"
            >
                <span class="back-icon">←</span>
                Kembali
            </a>

        </div>

    </div>


    {{-- =====================================================
        RINGKASAN
    ====================================================== --}}

    <div class="row g-3 mb-4">

        {{-- CUSTOMER --}}

        <div class="col-md-4">

            <div class="summary-card">

                <div class="summary-icon customer-icon">
                    👤
                </div>

                <div class="summary-content">

                    <div class="summary-label">
                        Customer
                    </div>

                    <div class="summary-value customer-name">
                        {{ $nama_customer }}
                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL TRANSAKSI --}}

        <div class="col-md-4">

            <div class="summary-card">

                <div class="summary-icon transaction-icon">
                    🧾
                </div>

                <div class="summary-content">

                    <div class="summary-label">
                        Total Transaksi
                    </div>

                    <div class="summary-value gold-value">
                        {{ number_format($penjualans->count(), 0, ',', '.') }}
                    </div>

                    <div class="summary-sub">
                        Transaksi tercatat
                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL PEMBELIAN --}}

        <div class="col-md-4">

            <div class="summary-card">

                <div class="summary-icon money-icon">
                    💰
                </div>

                <div class="summary-content">

                    <div class="summary-label">
                        Total Pembelian
                    </div>

                    <div class="summary-value money-value">

                        Rp {{ number_format(
                            $penjualans->sum('total'),
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                    <div class="summary-sub">
                        Nilai seluruh transaksi
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        DAFTAR TRANSAKSI
    ====================================================== --}}

    <div class="transaction-card">

        {{-- HEADER CARD --}}

        <div class="transaction-header">

            <div class="d-flex align-items-center gap-3">

                <div class="section-icon">
                    🧾
                </div>

                <div>

                    <h5 class="section-title mb-1">
                        Riwayat Stock Out
                    </h5>

                    <div class="section-description">
                        Semua transaksi untuk customer
                        <strong>{{ $nama_customer }}</strong>
                    </div>

                </div>

            </div>


            <div class="transaction-count">

                <span class="count-dot"></span>

                {{ $penjualans->count() }} Transaksi

            </div>

        </div>


        {{-- TABLE --}}

        <div class="transaction-body">

            <div class="table-responsive">

                <table class="table customer-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                style="width: 65px;"
                            >
                                No
                            </th>

                            <th style="width: 150px;">
                                No. Nota
                            </th>

                            <th style="width: 170px;">
                                Tanggal
                            </th>

                            <th>
                                Nama Barang
                            </th>

                            <th
                                class="text-center"
                                style="width: 110px;"
                            >
                                Jumlah
                            </th>

                            <th style="width: 180px;">
                                Total
                            </th>

                            <th
                                class="text-center"
                                style="width: 135px;"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($penjualans as $penjualan)

                            <tr>

                                {{-- NO --}}

                                <td class="text-center">

                                    <span class="row-number">
                                        {{ $loop->iteration }}
                                    </span>

                                </td>


                                {{-- NOMOR NOTA --}}

                                <td>

                                    <div class="nota-wrapper">

                                        <span class="nota-icon">
                                            #
                                        </span>

                                        <strong class="nota-number">
                                            {{ $penjualan->nomor_nota }}
                                        </strong>

                                    </div>

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    <div class="date-wrapper">

                                        <span class="date-icon">
                                            📅
                                        </span>

                                        <span>

                                            {{ $penjualan->tanggal_penjualan
                                                ? $penjualan->tanggal_penjualan->format('d/m/Y H:i')
                                                : '-' }}

                                        </span>

                                    </div>

                                </td>


                                {{-- NAMA BARANG --}}

                                <td>

                                    @if($penjualan->details->count() > 0)

                                        <div class="product-list">

                                            @foreach($penjualan->details as $detail)

                                                <div class="product-item">

                                                    <div class="product-main">

                                                        <span class="product-bullet"></span>

                                                        <span class="product-name">

                                                            {{ $detail->barang->nama_barang ?? 'Barang tidak ditemukan' }}

                                                        </span>

                                                    </div>


                                                    @if($detail->jumlah_koli > 0)

                                                        <span class="product-qty">

                                                            {{ number_format($detail->jumlah_koli) }}
                                                            Koli

                                                        </span>

                                                    @endif

                                                </div>

                                            @endforeach

                                        </div>

                                    @else

                                        <span class="empty-product">
                                            Tidak ada barang
                                        </span>

                                    @endif

                                </td>


                                {{-- JUMLAH BARANG --}}

                                <td class="text-center">

                                    <span class="quantity-badge">

                                        {{ $penjualan->details->count() }}

                                        <small>item</small>

                                    </span>

                                </td>


                                {{-- TOTAL --}}

                                <td>

                                    <div class="total-price">

                                        <span class="currency">
                                            Rp
                                        </span>

                                        <span>

                                            {{ number_format(
                                                $penjualan->total,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </span>

                                    </div>

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <a
                                        href="{{ route(
                                            'penjualan.show',
                                            [
                                                'penjualan' => $penjualan->id
                                            ]
                                        ) }}"
                                        class="btn-detail"
                                    >

                                        <span class="detail-icon">
                                            👁
                                        </span>

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">
                                        👥
                                    </div>

                                    <div class="empty-title">
                                        Belum ada transaksi
                                    </div>

                                    <div class="empty-description">
                                        Customer ini belum memiliki transaksi Stock Out.
                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- =================================================
                        TOTAL
                    ================================================== --}}

                    @if($penjualans->count() > 0)

                        <tfoot>

                            <tr>

                                <th
                                    colspan="5"
                                    class="total-label"
                                >
                                    TOTAL
                                </th>

                                <th>

                                    <div class="footer-total">

                                        <span class="currency">
                                            Rp
                                        </span>

                                        {{ number_format(
                                            $penjualans->sum('total'),
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </th>

                                <th></th>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    STYLE
========================================================= --}}

<style>

/* =========================================================
   PAGE HEADER
========================================================= */

.page-header {
    margin-bottom: 25px;
}

.page-icon {
    width: 46px;
    height: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        135deg,
        #fff8d8,
        #fffbea
    );

    border: 1px solid #f0e4ae;
    border-radius: 13px;

    font-size: 22px;

    box-shadow: 0 3px 10px rgba(212, 167, 0, .08);
}

.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
}

.breadcrumb-text {
    font-size: 12px;
    color: #9ca3af;
}

.breadcrumb-text .current {
    color: #a18200;
    font-weight: 600;
}

.page-description {
    font-size: 13px;
    color: #9ca3af;
    margin-left: 61px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 15px;

    background: #ffffff;
    border: 1px solid #e5e7eb;

    color: #4b5563;

    border-radius: 10px;

    font-size: 13px;
    font-weight: 600;

    transition: all .2s ease;
}

.btn-back:hover {
    background: #fffbea;
    border-color: #eadb9b;
    color: #a18200;
}

.back-icon {
    font-size: 17px;
    line-height: 1;
}


/* =========================================================
   SUMMARY
========================================================= */

.summary-card {
    height: 100%;

    display: flex;
    align-items: center;

    gap: 15px;

    padding: 18px;

    background: #ffffff;

    border: 1px solid #f0f0ef;
    border-radius: 14px;

    box-shadow: 0 3px 12px rgba(31, 41, 55, .045);

    transition: all .2s ease;
}

.summary-card:hover {
    transform: translateY(-2px);

    box-shadow: 0 6px 18px rgba(31, 41, 55, .07);
}

.summary-icon {
    width: 48px;
    height: 48px;

    flex: 0 0 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    font-size: 21px;
}

.customer-icon {
    background: #fff8d8;
    border: 1px solid #f0e4ae;
}

.transaction-icon {
    background: #fffbea;
    border: 1px solid #eee0a5;
}

.money-icon {
    background: #fff8d8;
    border: 1px solid #efdf91;
}

.summary-content {
    min-width: 0;
}

.summary-label {
    font-size: 12px;
    color: #9ca3af;
    margin-bottom: 4px;
}

.summary-value {
    font-size: 19px;
    font-weight: 700;
    line-height: 1.25;
}

.customer-name {
    color: #1f2937;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.gold-value {
    color: #b58e00;
}

.money-value {
    color: #a18200;
    font-size: 17px;
}

.summary-sub {
    margin-top: 4px;

    color: #b0b5bd;
    font-size: 11px;
}


/* =========================================================
   TRANSACTION CARD
========================================================= */

.transaction-card {
    background: #ffffff;

    border: 1px solid #eeeeec;
    border-radius: 15px;

    overflow: hidden;

    box-shadow: 0 4px 15px rgba(31, 41, 55, .045);
}

.transaction-header {
    min-height: 78px;

    padding: 17px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    border-bottom: 1px solid #f0f0ee;

    background:
        linear-gradient(
            90deg,
            #fffdf7 0%,
            #ffffff 60%
        );
}

.section-icon {
    width: 40px;
    height: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 11px;

    font-size: 18px;
}

.section-title {
    color: #1f2937;
    font-size: 16px;
    font-weight: 700;
}

.section-description {
    color: #9ca3af;
    font-size: 12px;
}

.section-description strong {
    color: #a18200;
    font-weight: 600;
}

.transaction-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 7px 11px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    color: #a18200;

    border-radius: 8px;

    font-size: 11px;
    font-weight: 700;

    white-space: nowrap;
}

.count-dot {
    width: 6px;
    height: 6px;

    background: #d4a700;

    border-radius: 50%;
}


/* =========================================================
   TABLE
========================================================= */

.transaction-body {
    width: 100%;
}

.customer-table {
    min-width: 1050px;
}

.customer-table thead th {
    padding: 13px 15px;

    background: #fafaf8;

    border-bottom: 1px solid #ecebe7;

    color: #6b7280;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: .45px;

    white-space: nowrap;
}

.customer-table tbody td {
    padding: 15px;

    border-color: #f1f1ef;

    color: #4b5563;

    font-size: 13px;

    vertical-align: middle;
}

.customer-table tbody tr {
    transition: background .15s ease;
}

.customer-table tbody tr:hover {
    background: #fffdf6;
}

.customer-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   NOMOR
========================================================= */

.row-number {
    width: 28px;
    height: 28px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: #f8f8f6;

    border: 1px solid #eeeeea;

    border-radius: 8px;

    color: #7b8088;

    font-size: 12px;
    font-weight: 700;
}


/* =========================================================
   NOTA
========================================================= */

.nota-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.nota-icon {
    width: 25px;
    height: 25px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: #fff8d8;

    border: 1px solid #f0e4ae;

    border-radius: 7px;

    color: #b58e00;

    font-size: 12px;
    font-weight: 800;
}

.nota-number {
    color: #374151;
    font-size: 13px;
}


/* =========================================================
   TANGGAL
========================================================= */

.date-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    white-space: nowrap;
}

.date-icon {
    font-size: 13px;
    opacity: .75;
}


/* =========================================================
   PRODUK
========================================================= */

.product-list {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.product-item {
    display: flex;
    align-items: center;
    flex-wrap: wrap;

    gap: 8px;
}

.product-main {
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.product-bullet {
    width: 6px;
    height: 6px;

    flex: 0 0 6px;

    background: #d4a700;

    border-radius: 50%;
}

.product-name {
    color: #374151;

    font-size: 13px;
    font-weight: 600;
}

.product-qty {
    display: inline-flex;
    align-items: center;

    padding: 3px 8px;

    background: #fffbea;

    border: 1px solid #f1e6b6;

    color: #a18200;

    border-radius: 6px;

    font-size: 10px;
    font-weight: 700;
}

.empty-product {
    color: #9ca3af;
    font-size: 12px;
    font-style: italic;
}


/* =========================================================
   JUMLAH
========================================================= */

.quantity-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;

    padding: 6px 10px;

    background: #f8f8f6;

    border: 1px solid #ecebe6;

    color: #5f6368;

    border-radius: 8px;

    font-size: 12px;
    font-weight: 700;
}

.quantity-badge small {
    font-size: 10px;
    font-weight: 600;
    color: #9ca3af;
}


/* =========================================================
   TOTAL HARGA
========================================================= */

.total-price {
    display: flex;
    align-items: baseline;
    gap: 4px;

    color: #a18200;

    font-size: 14px;
    font-weight: 700;

    white-space: nowrap;
}

.currency {
    font-size: 11px;
    font-weight: 600;
    color: #b59a43;
}


/* =========================================================
   DETAIL BUTTON
========================================================= */

.btn-detail {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 7px 11px;

    background: #fffbea;

    border: 1px solid #e9dc9d;

    color: #a18200;

    border-radius: 8px;

    font-size: 11px;
    font-weight: 700;

    text-decoration: none;

    transition: all .2s ease;
}

.btn-detail:hover {
    background: #fff4c2;

    border-color: #d4a700;

    color: #8d6f00;

    transform: translateY(-1px);
}

.detail-icon {
    font-size: 12px;
}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    padding: 60px 20px !important;

    text-align: center;

    color: #9ca3af;
}

.empty-icon {
    width: 56px;
    height: 56px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 12px;

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 15px;

    font-size: 24px;
}

.empty-title {
    color: #4b5563;

    font-size: 14px;
    font-weight: 700;

    margin-bottom: 4px;
}

.empty-description {
    color: #9ca3af;

    font-size: 12px;
}


/* =========================================================
   FOOTER TOTAL
========================================================= */

.customer-table tfoot th {
    padding: 16px 15px;

    background: #fffdf7;

    border-top: 1px solid #eee9d7;

    color: #a18200;
}

.total-label {
    font-size: 11px;
    font-weight: 800;

    letter-spacing: .5px;
}

.footer-total {
    display: flex;
    align-items: baseline;
    gap: 4px;

    color: #a18200;

    font-size: 15px;
    font-weight: 800;

    white-space: nowrap;
}


/* =========================================================
   SCROLLBAR TABLE
========================================================= */

.table-responsive {
    scrollbar-width: thin;
    scrollbar-color: #ddd5ad transparent;
}

.table-responsive::-webkit-scrollbar {
    height: 7px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f8f8f6;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #ddd5ad;
    border-radius: 10px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .page-title {
        font-size: 20px;
    }

    .page-description {
        margin-left: 0;
    }

    .page-icon {
        width: 42px;
        height: 42px;
        font-size: 20px;
    }

    .summary-card {
        padding: 15px;
    }

    .summary-icon {
        width: 43px;
        height: 43px;
        flex-basis: 43px;
    }

    .transaction-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .transaction-count {
        align-self: flex-start;
    }

    .customer-table {
        min-width: 1050px;
    }

}

@media (max-width: 576px) {

    .container-fluid {
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .page-header .d-flex {
        align-items: flex-start !important;
    }

    .btn-back {
        width: 100%;
        justify-content: center;
    }

    .summary-value {
        font-size: 17px;
    }

    .money-value {
        font-size: 15px;
    }

}

</style>

@endsection