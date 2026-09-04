@extends('layouts.app')

@section('title', 'Nota Penjualan')

@section('content')

<div class="nota-page">

    {{-- =====================================================
        HEADER HALAMAN
    ====================================================== --}}

    <div class="container-fluid px-3 px-md-4 py-3 no-print">

        <div class="d-flex flex-wrap justify-content-between align-items-center">

            <div>

                <div class="d-flex align-items-center gap-3">

                    <div class="page-icon">
                        🧾
                    </div>

                    <div>

                        <h3 class="page-title mb-1">
                            Nota Penjualan
                        </h3>

                        <p class="page-subtitle mb-0">
                            {{ $penjualan->nomor_nota }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="d-flex gap-2 mt-3 mt-md-0">

                <button
                    type="button"
                    onclick="window.print()"
                    class="btn btn-gold"
                >
                    🖨️ Cetak Nota
                </button>

                <a
                    href="{{ route('penjualan.index') }}"
                    class="btn btn-secondary-custom"
                >
                    Kembali
                </a>

            </div>

        </div>

    </div>


    {{-- =====================================================
        AREA NOTA
    ====================================================== --}}

    <div class="container-fluid px-3 px-md-4 pb-5">

        <div class="nota-paper" id="nota">

            {{-- =================================================
                HEADER NOTA
            ================================================== --}}

            <div class="nota-header">

                <div class="shop-info">

                    <div class="shop-name">
                        PERABOT HERI GROSIR
                    </div>

                    <div class="shop-subtitle">
                        NOTA PENJUALAN
                    </div>

                </div>


                <div class="invoice-info">

                    <div class="invoice-label">
                        NO. NOTA
                    </div>

                    <div class="invoice-number">
                        {{ $penjualan->nomor_nota }}
                    </div>

                </div>

            </div>


            <div class="nota-divider"></div>


            {{-- =================================================
                INFORMASI TRANSAKSI
            ================================================== --}}

            <div class="transaction-info">

                <div class="transaction-column">

                    <div class="info-row">

                        <span class="info-label">
                            CUSTOMER
                        </span>

                        <span class="info-value customer-name">
                            {{ $penjualan->nama_customer ?: '-' }}
                        </span>

                    </div>

                </div>


                <div class="transaction-column">

                    <div class="info-row">

                        <span class="info-label">
                            TANGGAL
                        </span>

                        <span class="info-value">

                            {{ $penjualan->tanggal_penjualan
                                ? $penjualan->tanggal_penjualan->format('d/m/Y H:i')
                                : '-' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                LABEL DETAIL
            ================================================== --}}

            <div class="section-label">
                DETAIL PEMBELIAN
            </div>


            {{-- =================================================
                DETAIL BARANG
            ================================================== --}}

            <div class="table-wrapper">

                <table class="nota-table">

                    <thead>

                        <tr>

                            <th
                                class="text-center col-no"
                            >
                                No
                            </th>

                            <th class="col-barang">
                                Nama Barang
                            </th>

                            <th
                                class="text-center col-koli"
                            >
                                Koli
                            </th>

                            <th
                                class="text-center col-pcs"
                            >
                                PCS
                            </th>

                            <th
                                class="text-end col-harga"
                            >
                                Harga
                            </th>

                            <th
                                class="text-end col-subtotal"
                            >
                                Subtotal
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($penjualan->details as $index => $detail)

                            <tr>

                                <td class="text-center item-number">
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <div class="item-name">

                                        @if($detail->barang)

                                            {{ $detail->barang->nama_barang
                                                ?? $detail->barang->nama
                                                ?? $detail->barang->kode_barang
                                                ?? 'Nama barang tidak tersedia' }}

                                        @else

                                            <span class="text-danger">
                                                Barang tidak ditemukan
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                <td class="text-center">

                                    <span class="qty-value">
                                        {{ $detail->jumlah_koli ?? 0 }}
                                    </span>

                                </td>


                                <td class="text-center">

                                    <span class="qty-value">
                                        {{ $detail->jumlah_pcs ?? 0 }}
                                    </span>

                                </td>


                                <td class="text-end price-value">

                                    Rp {{ number_format(
                                        $detail->harga ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                <td class="text-end subtotal-value">

                                    Rp {{ number_format(
                                        $detail->subtotal ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-detail"
                                >
                                    Belum ada detail barang.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                BAGIAN PEMBAYARAN
            ================================================== --}}

            <div class="payment-section">

                <div class="payment-left">

                    <div class="payment-note-title">
                        TERIMA KASIH
                    </div>

                    <div class="payment-note">

                        Terima kasih telah berbelanja di
                        <strong>Perabot Heri Grosir</strong>.

                    </div>

                    <div class="payment-note-small">
                        Barang yang sudah dibeli harap diperiksa kembali.
                    </div>

                </div>


                <div class="payment-summary">

                    {{-- TOTAL --}}

                    <div class="summary-row">

                        <span>
                            Total
                        </span>

                        <strong>

                            Rp {{ number_format(
                                $penjualan->total ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- DISKON --}}

                    <div class="summary-row">

                        <span>
                            Diskon
                        </span>

                        <strong class="discount-value">

                            Rp {{ number_format(
                                $penjualan->diskon ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- TOTAL AKHIR --}}

                    <div class="summary-row grand-total">

                        <span>
                            TOTAL BAYAR
                        </span>

                        <strong>

                            Rp {{ number_format(
                                $penjualan->total_setelah_diskon
                                ?? (
                                    ($penjualan->total ?? 0)
                                    - ($penjualan->diskon ?? 0)
                                ),
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- BAYAR CASH --}}

                    <div class="summary-row">

                        <span>
                            Bayar Cash
                        </span>

                        <strong>

                            Rp {{ number_format(
                                $penjualan->bayar_cash ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- HUTANG --}}

                    <div class="summary-row">

                        <span>
                            Hutang
                        </span>

                        <strong
                            class="{{ ($penjualan->hutang ?? 0) > 0 ? 'hutang-value' : '' }}"
                        >

                            Rp {{ number_format(
                                $penjualan->hutang ?? 0,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- STATUS --}}

                    <div class="summary-status">

                        <span>
                            STATUS
                        </span>

                        @if(($penjualan->hutang ?? 0) > 0)

                            <span class="status-badge status-hutang">
                                HUTANG
                            </span>

                        @else

                            <span class="status-badge status-lunas">
                                LUNAS
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =================================================
                FOOTER / TANDA TANGAN
            ================================================== --}}

            <div class="nota-footer">

                <div class="footer-message">

                    <div class="footer-thanks">
                        Terima kasih atas pembelian Anda.
                    </div>

                    <div class="footer-small">
                        Simpan nota ini sebagai bukti transaksi.
                    </div>

                </div>


                <div class="signature-area">

                    <div class="signature-title">
                        Kasir
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-line"></div>

                </div>

            </div>


            {{-- =================================================
                FOOTER NOTA
            ================================================== --}}

            <div class="nota-bottom">

                <span>
                    {{ $penjualan->nomor_nota }}
                </span>

                <span>
                    Terima kasih
                </span>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    STYLE
========================================================= --}}

<style>

/* =========================================================
   PAGE
========================================================= */

.nota-page {

    min-height: 100vh;

    background:
        linear-gradient(
            180deg,
            #fafafa 0%,
            #f7f7f7 100%
        );

    color: #374151;

}


/* =========================================================
   PAGE HEADER
========================================================= */

.page-title {

    color: #374151;

    font-weight: 700;

    letter-spacing: -.3px;

}


.page-subtitle {

    color: #9ca3af;

    font-size: 14px;

}


.page-icon {

    width: 46px;

    height: 46px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );

    border: 1px solid #f0e4ae;

    box-shadow:
        0 4px 12px rgba(212,167,0,.08);

    font-size: 21px;

}


/* =========================================================
   BUTTON
========================================================= */

.btn-gold {

    border: 1px solid #d4a700;

    background:
        linear-gradient(
            135deg,
            #d9b52e,
            #c99f00
        );

    color: #fff;

    border-radius: 10px;

    font-weight: 600;

    padding: 9px 16px;

    box-shadow:
        0 4px 10px rgba(212,167,0,.16);

    transition: all .2s ease;

}


.btn-gold:hover {

    color: #fff;

    transform: translateY(-1px);

    box-shadow:
        0 6px 14px rgba(212,167,0,.22);

}


.btn-secondary-custom {

    background: #fff;

    border: 1px solid #e5e7eb;

    color: #6b7280;

    border-radius: 10px;

    font-weight: 600;

    padding: 9px 16px;

    transition: all .2s ease;

}


.btn-secondary-custom:hover {

    background: #f9fafb;

    border-color: #d1d5db;

    color: #374151;

}


/* =========================================================
   NOTA PAPER
========================================================= */

.nota-paper {

    width: 100%;

    max-width: 1050px;

    margin: 10px auto 40px;

    background: #fff;

    border: 1px solid #e5e7eb;

    border-radius: 4px;

    box-shadow:
        0 8px 30px rgba(17,24,39,.08);

    padding: 50px 55px;

    position: relative;

}


/* =========================================================
   HEADER NOTA
========================================================= */

.nota-header {

    display: flex;

    justify-content: space-between;

    align-items: flex-start;

    gap: 30px;

}


.shop-info {

    flex: 1;

}


.shop-name {

    font-size: 25px;

    font-weight: 800;

    color: #222;

    letter-spacing: .2px;

}


.shop-subtitle {

    margin-top: 5px;

    font-size: 13px;

    color: #8b7000;

    font-weight: 700;

    letter-spacing: 1.6px;

}


.invoice-info {

    min-width: 190px;

    text-align: right;

}


.invoice-label {

    font-size: 11px;

    color: #9ca3af;

    font-weight: 700;

    letter-spacing: 1px;

}


.invoice-number {

    margin-top: 4px;

    font-size: 17px;

    font-weight: 800;

    color: #a18200;

}


.nota-divider {

    height: 2px;

    background:
        linear-gradient(
            90deg,
            #d4a700 0%,
            #e9d98a 55%,
            #f3f4f6 100%
        );

    margin: 25px 0;

}


/* =========================================================
   TRANSACTION INFO
========================================================= */

.transaction-info {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 35px;

    margin-bottom: 30px;

}


.transaction-column {

    min-width: 0;

}


.info-row {

    display: flex;

    flex-direction: column;

    gap: 4px;

}


.info-label {

    font-size: 10px;

    color: #9ca3af;

    font-weight: 700;

    letter-spacing: 1px;

}


.info-value {

    font-size: 14px;

    font-weight: 600;

    color: #374151;

}


.customer-name {

    font-size: 16px;

    color: #1f2937;

    word-break: break-word;

}


/* =========================================================
   SECTION LABEL
========================================================= */

.section-label {

    font-size: 11px;

    color: #6b7280;

    font-weight: 800;

    letter-spacing: 1px;

    padding-bottom: 9px;

    border-bottom: 1px solid #e5e7eb;

    margin-bottom: 0;

}


/* =========================================================
   TABLE WRAPPER
========================================================= */

.table-wrapper {

    width: 100%;

    max-width: 100%;

    overflow-x: hidden !important;

    overflow-y: hidden !important;

}


/* =========================================================
   TABLE
========================================================= */

.nota-table {

    width: 100%;

    max-width: 100%;

    border-collapse: collapse;

    table-layout: fixed;

    font-size: 13px;

}


/* =========================================================
   COLUMN WIDTH
========================================================= */

.nota-table .col-no {

    width: 6%;

}


.nota-table .col-barang {

    width: 34%;

}


.nota-table .col-koli {

    width: 10%;

}


.nota-table .col-pcs {

    width: 10%;

}


.nota-table .col-harga {

    width: 19%;

}


.nota-table .col-subtotal {

    width: 21%;

}


/* =========================================================
   TABLE HEADER
========================================================= */

.nota-table thead th {

    background: #faf9f3;

    border-bottom: 1px solid #ded8bd;

    color: #5f5b49;

    font-size: 10px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .6px;

    padding: 12px 8px;

    white-space: nowrap;

}


/* =========================================================
   TABLE BODY
========================================================= */

.nota-table tbody td {

    border-bottom: 1px solid #eeeeee;

    padding: 14px 8px;

    color: #374151;

    vertical-align: middle;

    overflow-wrap: break-word;

    word-wrap: break-word;

}


.nota-table tbody tr:last-child td {

    border-bottom: 1px solid #dedede;

}


.nota-table tbody tr:hover {

    background: #fffdf7;

}


.item-number {

    color: #9ca3af;

    font-size: 12px;

}


.item-name {

    font-weight: 600;

    color: #30343b;

    line-height: 1.4;

    word-break: break-word;

    overflow-wrap: anywhere;

}


.qty-value {

    display: inline-block;

    min-width: 20px;

    color: #4b5563;

    font-weight: 600;

}


.price-value {

    color: #6b7280;

    white-space: normal;

    overflow-wrap: anywhere;

}


.subtotal-value {

    color: #1f2937;

    font-weight: 700;

    white-space: normal;

    overflow-wrap: anywhere;

}


.empty-detail {

    text-align: center;

    color: #9ca3af !important;

    padding: 35px 15px !important;

}


/* =========================================================
   PAYMENT SECTION
========================================================= */

.payment-section {

    display: grid;

    grid-template-columns: 1fr 380px;

    gap: 50px;

    margin-top: 28px;

    padding-top: 25px;

    border-top: 1px solid #e5e7eb;

}


.payment-left {

    padding-top: 5px;

}


.payment-note-title {

    font-size: 12px;

    font-weight: 800;

    letter-spacing: .8px;

    color: #8b7000;

    margin-bottom: 8px;

}


.payment-note {

    color: #6b7280;

    font-size: 13px;

    line-height: 1.7;

}


.payment-note strong {

    color: #374151;

}


.payment-note-small {

    margin-top: 8px;

    color: #9ca3af;

    font-size: 11px;

    line-height: 1.6;

}


/* =========================================================
   SUMMARY
========================================================= */

.payment-summary {

    width: 100%;

}


.summary-row {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 25px;

    padding: 7px 0;

    font-size: 13px;

    color: #6b7280;

}


.summary-row strong {

    color: #374151;

    font-weight: 700;

    white-space: nowrap;

}


.discount-value {

    color: #9b7d00 !important;

}


.grand-total {

    margin: 8px 0;

    padding: 13px 14px;

    background:
        linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );

    border: 1px solid #eee3a8;

    border-radius: 6px;

}


.grand-total span {

    color: #5f531d;

    font-weight: 800;

    font-size: 12px;

    letter-spacing: .4px;

}


.grand-total strong {

    color: #a18200;

    font-size: 18px;

}


.hutang-value {

    color: #b45309 !important;

}


/* =========================================================
   STATUS
========================================================= */

.summary-status {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-top: 9px;

    padding-top: 12px;

    border-top: 1px dashed #d9d9d9;

    font-size: 11px;

    font-weight: 800;

    color: #6b7280;

    letter-spacing: .5px;

}


.status-badge {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 75px;

    padding: 5px 12px;

    border-radius: 20px;

    font-size: 10px;

    font-weight: 800;

    letter-spacing: .5px;

}


.status-lunas {

    background: #ecfdf3;

    color: #15803d;

    border: 1px solid #bbf7d0;

}


.status-hutang {

    background: #fff7ed;

    color: #c2410c;

    border: 1px solid #fed7aa;

}


/* =========================================================
   FOOTER
========================================================= */

.nota-footer {

    display: flex;

    justify-content: space-between;

    align-items: flex-end;

    gap: 40px;

    margin-top: 55px;

}


.footer-message {

    flex: 1;

}


.footer-thanks {

    font-size: 13px;

    font-weight: 600;

    color: #4b5563;

}


.footer-small {

    margin-top: 4px;

    font-size: 11px;

    color: #9ca3af;

}


.signature-area {

    width: 150px;

    text-align: center;

}


.signature-title {

    font-size: 12px;

    color: #6b7280;

    font-weight: 600;

}


.signature-space {

    height: 45px;

}


.signature-line {

    width: 100%;

    border-top: 1px solid #9ca3af;

}


/* =========================================================
   BOTTOM NOTA
========================================================= */

.nota-bottom {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-top: 35px;

    padding-top: 10px;

    border-top: 1px dashed #d1d5db;

    color: #b0b3b8;

    font-size: 9px;

    letter-spacing: .4px;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .nota-paper {

        padding: 25px 16px;

        margin-top: 5px;

    }


    .nota-header {

        flex-direction: column;

        gap: 15px;

    }


    .invoice-info {

        text-align: left;

        min-width: 0;

    }


    .shop-name {

        font-size: 21px;

    }


    .shop-subtitle {

        font-size: 11px;

    }


    .transaction-info {

        grid-template-columns: 1fr;

        gap: 15px;

        margin-bottom: 20px;

    }


    .payment-section {

        grid-template-columns: 1fr;

        gap: 25px;

    }


    .payment-summary {

        width: 100%;

    }


    .nota-footer {

        flex-direction: column;

        align-items: stretch;

    }


    .signature-area {

        margin-left: auto;

    }


    /*
     * PENTING:
     * Tidak menggunakan min-width pada tabel.
     * Ini mencegah scrollbar horizontal.
     */

    .table-wrapper {

        width: 100%;

        max-width: 100%;

        overflow-x: hidden !important;

    }


    .nota-table {

        width: 100%;

        min-width: 0 !important;

        table-layout: fixed;

    }


    .nota-table thead th {

        font-size: 8px;

        padding: 8px 4px;

    }


    .nota-table tbody td {

        font-size: 10px;

        padding: 9px 4px;

    }


    .nota-table .col-no {

        width: 6%;

    }


    .nota-table .col-barang {

        width: 34%;

    }


    .nota-table .col-koli {

        width: 10%;

    }


    .nota-table .col-pcs {

        width: 10%;

    }


    .nota-table .col-harga {

        width: 20%;

    }


    .nota-table .col-subtotal {

        width: 20%;

    }


    .price-value,
    .subtotal-value {

        font-size: 9px !important;

    }


    .item-name {

        font-size: 10px;

    }

}


/* =========================================================
   PRINT - 1 HALAMAN A4
========================================================= */

@media print {

    @page {

        size: A4 portrait;

        margin: 5mm;

    }


    html,
    body {

        width: 100% !important;

        height: auto !important;

        margin: 0 !important;

        padding: 0 !important;

        background: #fff !important;

    }


    body {

        -webkit-print-color-adjust: exact !important;

        print-color-adjust: exact !important;

    }


    /* SEMBUNYIKAN BAGIAN WEBSITE */

    .no-print,
    .sidebar,
    nav,
    header,
    footer,
    .btn {

        display: none !important;

    }


    /* PAGE */

    .nota-page {

        width: 100% !important;

        min-height: 0 !important;

        background: #fff !important;

        margin: 0 !important;

        padding: 0 !important;

    }


    .container-fluid {

        width: 100% !important;

        max-width: 100% !important;

        padding: 0 !important;

        margin: 0 !important;

    }


    /* NOTA */

    .nota-paper {

        width: 100% !important;

        max-width: none !important;

        margin: 0 !important;

        padding: 5mm !important;

        border: 0 !important;

        border-radius: 0 !important;

        box-shadow: none !important;

        overflow: hidden !important;

    }


    /* HEADER */

    .nota-header {

        display: flex !important;

        flex-direction: row !important;

        align-items: flex-start !important;

        justify-content: space-between !important;

        gap: 20px !important;

    }


    .shop-name {

        font-size: 20px !important;

    }


    .shop-subtitle {

        font-size: 9px !important;

        margin-top: 2px !important;

    }


    .invoice-info {

        text-align: right !important;

        min-width: 150px !important;

    }


    .invoice-label {

        font-size: 8px !important;

    }


    .invoice-number {

        font-size: 12px !important;

    }


    .nota-divider {

        margin: 10px 0 !important;

    }


    /* INFORMASI */

    .transaction-info {

        display: grid !important;

        grid-template-columns: 1fr 1fr !important;

        gap: 20px !important;

        margin-bottom: 13px !important;

    }


    .info-label {

        font-size: 7px !important;

    }


    .info-value {

        font-size: 10px !important;

    }


    .customer-name {

        font-size: 12px !important;

    }


    /* DETAIL */

    .section-label {

        font-size: 8px !important;

        padding-bottom: 5px !important;

    }


    .table-wrapper {

        width: 100% !important;

        max-width: 100% !important;

        overflow: hidden !important;

    }


    .nota-table {

        width: 100% !important;

        max-width: 100% !important;

        min-width: 0 !important;

        table-layout: fixed !important;

        font-size: 9px !important;

    }


    .nota-table thead th {

        font-size: 7px !important;

        padding: 6px 4px !important;

    }


    .nota-table tbody td {

        padding: 6px 4px !important;

        font-size: 9px !important;

    }


    .item-name {

        font-size: 9px !important;

    }


    .qty-value {

        font-size: 9px !important;

    }


    .price-value,
    .subtotal-value {

        font-size: 9px !important;

        white-space: nowrap !important;

    }


    /* PEMBAYARAN */

    .payment-section {

        display: grid !important;

        grid-template-columns: 1fr 300px !important;

        gap: 20px !important;

        margin-top: 12px !important;

        padding-top: 12px !important;

    }


    .payment-note-title {

        font-size: 8px !important;

        margin-bottom: 3px !important;

    }


    .payment-note {

        font-size: 8px !important;

        line-height: 1.35 !important;

    }


    .payment-note-small {

        font-size: 7px !important;

        margin-top: 3px !important;

    }


    .summary-row {

        font-size: 9px !important;

        padding: 3px 0 !important;

    }


    .grand-total {

        padding: 7px 9px !important;

        margin: 3px 0 !important;

    }


    .grand-total span {

        font-size: 8px !important;

    }


    .grand-total strong {

        font-size: 13px !important;

    }


    .summary-status {

        margin-top: 4px !important;

        padding-top: 6px !important;

        font-size: 8px !important;

    }


    .status-badge {

        min-width: 55px !important;

        padding: 3px 7px !important;

        font-size: 7px !important;

    }


    /* FOOTER */

    .nota-footer {

        display: flex !important;

        flex-direction: row !important;

        align-items: flex-end !important;

        justify-content: space-between !important;

        gap: 20px !important;

        margin-top: 15px !important;

    }


    .footer-thanks {

        font-size: 8px !important;

    }


    .footer-small {

        font-size: 7px !important;

        margin-top: 2px !important;

    }


    .signature-area {

        width: 100px !important;

        margin-left: 0 !important;

    }


    .signature-title {

        font-size: 8px !important;

    }


    .signature-space {

        height: 20px !important;

    }


    .signature-line {

        width: 100% !important;

    }


    /* FOOTER BAWAH */

    .nota-bottom {

        margin-top: 9px !important;

        padding-top: 4px !important;

        font-size: 6px !important;

    }


    /* JANGAN BUAT ELEMEN MENGHASILKAN HALAMAN BARU */

    #nota,
    .nota-header,
    .transaction-info,
    .section-label,
    .table-wrapper,
    .payment-section,
    .nota-footer,
    .nota-bottom {

        page-break-before: auto !important;

        page-break-after: auto !important;

    }

}

</style>

@endsection