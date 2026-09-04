@extends('layouts.app')

@section('title', 'Stock Out')

@section('content')

<style>
    /* =========================================================
       PAGE
    ========================================================= */

    .stockout-page {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        overflow-x: hidden;
        color: #374151;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 25px;
    }

    .header-content {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .page-icon {
        width: 46px;
        height: 46px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 14px;

        background: linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );

        border: 1px solid #f0e4ae;

        box-shadow:
            0 4px 12px rgba(212, 167, 0, .08);

        font-size: 21px;

        flex-shrink: 0;
    }

    .stock-title {
        margin: 0 0 5px;
        color: #374151;
        font-size: 25px;
        font-weight: 700;
        letter-spacing: -.3px;
    }

    .stock-subtitle {
        margin: 0;
        color: #9ca3af;
        font-size: 14px;
    }


    /* =========================================================
       BUTTON BUAT NOTA
    ========================================================= */

    .btn-create {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 10px 17px;

        background: linear-gradient(
            135deg,
            #d9b52e,
            #c99f00
        );

        color: #ffffff;

        border: 1px solid #d4a700;
        border-radius: 10px;

        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        white-space: nowrap;
        flex-shrink: 0;

        box-shadow:
            0 4px 10px rgba(212, 167, 0, .16);

        transition: all .2s ease;
    }

    .btn-create:hover {
        background: linear-gradient(
            135deg,
            #cdaa22,
            #b99000
        );

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 6px 14px rgba(212, 167, 0, .20);
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-custom {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 12px 15px;
        margin-bottom: 18px;

        border-radius: 10px;

        font-size: 14px;
    }

    .alert-success-custom {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .alert-danger-custom {
        background: #fff7f7;
        color: #b45353;
        border: 1px solid #fecaca;
    }

    .alert-icon {
        font-weight: 700;
        flex-shrink: 0;
    }

    .alert-close {
        margin-left: auto;

        border: 0;
        background: transparent;

        color: inherit;

        font-size: 21px;
        line-height: 1;

        cursor: pointer;
        flex-shrink: 0;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .stock-card {
        width: 100%;
        max-width: 100%;

        background: #ffffff;

        border: 1px solid #e8e9ec;
        border-radius: 16px;

        box-shadow:
            0 5px 18px rgba(17, 24, 39, .055);

        overflow: hidden;

        box-sizing: border-box;
    }


    /* =========================================================
       SEARCH AREA
    ========================================================= */

    .search-area {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 20px;

        padding: 17px 20px;

        border-bottom: 1px solid #eee7c9;

        background: linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );
    }

    .search-box {
        position: relative;

        width: 390px;
        max-width: 100%;
    }

    .search-icon {
        position: absolute;

        left: 14px;
        top: 50%;

        transform: translateY(-50%);

        font-size: 15px;

        pointer-events: none;

        opacity: .75;
    }

    .search-input {
        width: 100%;
        height: 42px;

        padding: 0 42px 0 40px;

        border: 1px solid #dfe2e7;
        border-radius: 10px;

        outline: none;

        color: #374151;
        background: #ffffff;

        font-size: 14px;

        box-sizing: border-box;

        transition: all .2s ease;
    }

    .search-input::placeholder {
        color: #9ca3af;
    }

    .search-input:hover {
        border-color: #d4c47c;
    }

    .search-input:focus {
        border-color: #d9bc42;

        box-shadow:
            0 0 0 3px rgba(212, 167, 0, .10);
    }

    .clear-search {
        position: absolute;

        right: 8px;
        top: 50%;

        transform: translateY(-50%);

        width: 27px;
        height: 27px;

        display: none;

        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 50%;

        background: transparent;

        color: #9ca3af;

        font-size: 18px;

        cursor: pointer;
    }

    .clear-search:hover {
        background: #fffbea;
        color: #8b7000;
    }

    .search-info {
        color: #9ca3af;

        font-size: 13px;

        white-space: nowrap;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .table-wrapper {
        width: 100%;
        max-width: 100%;

        overflow: hidden;
    }

    .stock-table {
        width: 100%;
        max-width: 100%;

        border-collapse: collapse;

        table-layout: fixed;

        margin: 0;

        font-size: 13px;
    }


    /* =========================================================
       TABLE HEADER
    ========================================================= */

    .stock-table thead th {
        padding: 14px 8px;

        background: #f9fafb;

        color: #6b7280;

        border-bottom: 1px solid #e5e7eb;

        font-size: 12px;
        font-weight: 700;

        vertical-align: middle;

        text-align: center;

        white-space: normal;

        overflow-wrap: break-word;
        word-break: normal;

        line-height: 1.35;
    }


    /* =========================================================
       TABLE BODY
    ========================================================= */

    .stock-table tbody td {
        padding: 15px 8px;

        border-bottom: 1px solid #f1f3f5;

        color: #374151;

        vertical-align: middle;

        white-space: normal;

        overflow-wrap: break-word;
        word-break: normal;

        line-height: 1.45;
    }

    .stock-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .stock-table tbody tr {
        transition: background-color .15s ease;
    }

    .stock-table tbody tr:hover {
        background: #fffef8;
    }


    /* =========================================================
       COLUMN WIDTH
       TOTAL = 100%
    ========================================================= */

    .col-no {
        width: 5%;
    }

    .col-nota {
        width: 14%;
    }

    .col-tanggal {
        width: 11%;
    }

    .col-customer {
        width: 15%;
    }

    .col-barang {
        width: 7%;
    }

    .col-diskon {
        width: 7%;
    }

    .col-harga {
        width: 14%;
    }

    .col-total {
        width: 14%;
    }

    .col-status {
        width: 7%;
    }

    .col-aksi {
        width: 6%;
    }


    /* =========================================================
       NUMBER
    ========================================================= */

    .number-badge {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        width: 31px;
        height: 31px;

        border-radius: 50%;

        background: #f5f6f8;

        color: #6b7280;

        border: 1px solid #e5e7eb;

        font-size: 12px;
        font-weight: 600;
    }


    /* =========================================================
       NOTA
    ========================================================= */

    .nota-text {
        display: block;

        color: #a18200;

        font-weight: 700;
        font-size: 12px;

        line-height: 1.5;

        overflow-wrap: anywhere;
        word-break: break-word;
    }


    /* =========================================================
       TANGGAL
    ========================================================= */

    .date-text {
        color: #4b5563;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;
    }

    .time-text {
        margin-top: 3px;

        color: #9ca3af;

        font-size: 11px;
    }


    /* =========================================================
       CUSTOMER
    ========================================================= */

    .customer-text {
        display: block;

        max-width: 100%;

        color: #4b5563;

        font-size: 12px;

        font-weight: 500;

        line-height: 1.45;

        overflow-wrap: anywhere;
        word-break: break-word;
    }


    /* =========================================================
       BARANG
    ========================================================= */

    .barang-badge {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 32px;
        height: 31px;

        padding: 0 8px;

        border-radius: 8px;

        background: #fffbea;

        color: #a18200;

        border: 1px solid #f0e4ae;

        font-size: 12px;

        font-weight: 700;
    }


    /* =========================================================
       MONEY
    ========================================================= */

    .money-text {
        display: block;

        color: #4b5563;

        font-size: 12px;

        font-weight: 600;

        white-space: nowrap;
    }

    .diskon-text {
        color: #9ca3af;
    }

    .total-text {
        display: block;

        color: #a18200;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .payment-status {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 62px;

        padding: 6px 7px;

        border-radius: 8px;

        font-size: 10px;

        font-weight: 700;

        text-align: center;

        white-space: normal;

        line-height: 1.2;
    }

    .status-lunas {
        background: #f0fdf4;

        color: #15803d;

        border: 1px solid #bbf7d0;
    }

    .status-hutang {
        background: #fffbea;

        color: #9a6700;

        border: 1px solid #f0d878;
    }


    /* =========================================================
       ACTION
    ========================================================= */

    .action-buttons {
        display: flex;

        align-items: center;
        justify-content: center;

        gap: 5px;

        white-space: nowrap;
    }

    .delete-form {
        margin: 0;
        padding: 0;
    }

    .action-btn {
        width: 32px;
        height: 32px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 0;

        border-radius: 8px;

        background: #ffffff;

        font-size: 12px;

        line-height: 1;

        text-decoration: none;

        cursor: pointer;

        transition: all .2s ease;
    }

    .detail-btn {
        border: 1px solid #e1d48d;

        color: #a18200;

        background: #fffdf7;
    }

    .detail-btn:hover {
        background: #fffbea;

        border-color: #d4b72e;

        color: #8b7000;

        transform: translateY(-1px);
    }

    .delete-btn {
        border: 1px solid #fecaca;

        color: #b45353;

        background: #fffafa;
    }

    .delete-btn:hover {
        background: #fff1f1;

        border-color: #e5aaaa;

        color: #a33d3d;

        transform: translateY(-1px);
    }


    /* =========================================================
       EMPTY
    ========================================================= */

    .empty-cell {
        padding: 0 !important;

        text-align: center;
    }

    .empty-state,
    .search-empty-state {
        padding: 50px 20px;
    }

    .empty-icon,
    .search-empty-icon {
        font-size: 40px;

        margin-bottom: 10px;
    }

    .empty-title {
        margin-bottom: 6px;

        color: #4b5563;

        font-size: 14px;

        font-weight: 700;
    }

    .empty-text {
        margin-bottom: 17px;

        color: #9ca3af;

        font-size: 12px;
    }

    .empty-button,
    .reset-search-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 9px 14px;

        border: 1px solid #d4a700;

        border-radius: 9px;

        background: linear-gradient(
            135deg,
            #d9b52e,
            #c99f00
        );

        color: #ffffff;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

        cursor: pointer;

        transition: all .2s ease;
    }

    .empty-button:hover,
    .reset-search-btn:hover {
        background: linear-gradient(
            135deg,
            #cdaa22,
            #b99000
        );

        color: #ffffff;

        transform: translateY(-1px);
    }


    /* =========================================================
       TABLET
    ========================================================= */

    @media (max-width: 1100px) {

        .stock-title {
            font-size: 23px;
        }

        .stock-subtitle {
            font-size: 13px;
        }

        .search-area {
            padding: 15px;
        }

        .stock-table {
            font-size: 11px;
        }

        .stock-table thead th {
            padding: 11px 5px;
            font-size: 10px;
        }

        .stock-table tbody td {
            padding: 11px 5px;
            font-size: 10px;
        }

        .nota-text,
        .customer-text {
            font-size: 10px;
        }

        .date-text {
            font-size: 10px;
        }

        .time-text {
            font-size: 9px;
        }

        .money-text,
        .total-text {
            font-size: 9px;
        }

        .number-badge {
            width: 27px;
            height: 27px;
            font-size: 10px;
        }

        .barang-badge {
            min-width: 28px;
            height: 27px;
            font-size: 10px;
        }

        .payment-status {
            min-width: 53px;
            padding: 5px;
            font-size: 8px;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            font-size: 10px;
        }

        .action-buttons {
            gap: 3px;
        }
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 700px) {

        .page-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 12px;
        }

        .header-content {
            width: 100%;
        }

        .stock-title {
            font-size: 21px;
        }

        .stock-subtitle {
            font-size: 12px;
        }

        .btn-create {
            width: 100%;
        }

        .search-area {
            flex-direction: column;

            align-items: stretch;

            padding: 14px;
        }

        .search-box {
            width: 100%;
        }

        .search-info {
            white-space: normal;

            font-size: 12px;
        }

        .stock-table {
            font-size: 9px;
        }

        .stock-table thead th {
            padding: 8px 3px;

            font-size: 8px;
        }

        .stock-table tbody td {
            padding: 9px 3px;

            font-size: 8px;
        }

        .nota-text,
        .customer-text {
            font-size: 8px;
        }

        .date-text {
            font-size: 8px;
        }

        .time-text {
            font-size: 7px;
        }

        .money-text,
        .total-text {
            font-size: 7px;
        }

        .number-badge {
            width: 23px;
            height: 23px;

            font-size: 8px;
        }

        .barang-badge {
            min-width: 23px;
            height: 23px;

            padding: 0 4px;

            font-size: 8px;
        }

        .payment-status {
            min-width: 42px;

            padding: 4px 3px;

            font-size: 7px;
        }

        .action-buttons {
            flex-direction: row;

            gap: 2px;
        }

        .action-btn {
            width: 23px;
            height: 23px;

            font-size: 8px;
        }

        .page-icon {
            width: 42px;
            height: 42px;
            font-size: 19px;
        }
    }
</style>


<div class="stockout-page">


    {{-- =====================================================
    HEADER
    ====================================================== --}}

    <div class="page-header">

        <div class="header-content">

            <div class="page-icon">
                📤
            </div>

            <div>

                <h3 class="stock-title">
                    Stock Out
                </h3>

                <p class="stock-subtitle">
                    Daftar barang yang terjual
                </p>

            </div>

        </div>


        <a
            href="{{ route('penjualan.create') }}"
            class="btn-create"
        >

            <span>＋</span>

            <span>
                Buat Nota
            </span>

        </a>

    </div>



    {{-- =====================================================
    SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert-custom alert-success-custom">

            <span class="alert-icon">
                ✓
            </span>

            <span>
                {{ session('success') }}
            </span>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif



    {{-- =====================================================
    ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="alert-custom alert-danger-custom">

            <span class="alert-icon">
                ⚠
            </span>

            <span>
                {{ session('error') }}
            </span>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif



    {{-- =====================================================
    STOCK OUT TABLE
    ====================================================== --}}

    <div class="stock-card">


        {{-- =================================================
        SEARCH
        ================================================== --}}

        <div class="search-area">


            <div class="search-box">

                <span class="search-icon">
                    🔍
                </span>


                <input
                    type="text"
                    id="stockSearch"
                    class="search-input"
                    placeholder="Cari No. Nota atau Customer..."
                    autocomplete="off"
                >


                <button
                    type="button"
                    id="clearSearch"
                    class="clear-search"
                    title="Hapus pencarian"
                >
                    ×
                </button>

            </div>


            <div id="searchInfo" class="search-info">
                Menampilkan semua transaksi
            </div>

        </div>



        {{-- =================================================
        TABLE
        ================================================== --}}

        <div class="table-wrapper">

            <table
                class="stock-table"
                id="stockTable"
            >

                <thead>

                    <tr>

                        <th class="col-no">
                            No
                        </th>


                        <th class="col-nota">
                            No. Nota
                        </th>


                        <th class="col-tanggal">
                            Tanggal
                        </th>


                        <th class="col-customer">
                            Customer
                        </th>


                        <th class="col-barang">
                            Barang
                        </th>


                        <th class="col-diskon">
                            Diskon
                        </th>


                        <th class="col-harga">
                            Harga
                        </th>


                        <th class="col-total">
                            Total
                        </th>


                        <th class="col-status">
                            Status
                        </th>


                        <th class="col-aksi">
                            Aksi
                        </th>

                    </tr>

                </thead>



                <tbody id="stockTableBody">


                    @forelse($penjualans as $index => $penjualan)

                        <tr
                            class="stock-row"
                            data-nota="{{ strtolower($penjualan->nomor_nota ?? '') }}"
                            data-customer="{{ strtolower($penjualan->nama_customer ?? '') }}"
                        >


                            {{-- =================================
                            NO
                            ================================== --}}

                            <td class="text-center">

                                <span class="number-badge">

                                    {{ $index + 1 }}

                                </span>

                            </td>



                            {{-- =================================
                            NO NOTA
                            ================================== --}}

                            <td>

                                <span class="nota-text">

                                    {{ $penjualan->nomor_nota ?? '-' }}

                                </span>

                            </td>



                            {{-- =================================
                            TANGGAL
                            ================================== --}}

                            <td>

                                @if($penjualan->tanggal_penjualan)

                                    <div class="date-text">

                                        {{
                                            $penjualan
                                                ->tanggal_penjualan
                                                ->format('d/m/Y')
                                        }}

                                    </div>


                                    <div class="time-text">

                                        {{
                                            $penjualan
                                                ->tanggal_penjualan
                                                ->format('H:i')
                                        }}

                                    </div>

                                @else

                                    -

                                @endif

                            </td>



                            {{-- =================================
                            CUSTOMER
                            ================================== --}}

                            <td>

                                <span
                                    class="customer-text"
                                    title="{{ $penjualan->nama_customer }}"
                                >

                                    {{
                                        $penjualan->nama_customer
                                        ?: '-'
                                    }}

                                </span>

                            </td>



                            {{-- =================================
                            JUMLAH BARANG
                            ================================== --}}

                            <td class="text-center">

                                <span class="barang-badge">

                                    {{
                                        $penjualan
                                            ->details
                                            ->count()
                                    }}

                                </span>

                            </td>



                            {{-- =================================
                            DISKON
                            ================================== --}}

                            <td class="text-center">

                                <span class="money-text diskon-text">

                                    Rp
                                    {{
                                        number_format(
                                            $penjualan->diskon ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </span>

                            </td>



                            {{-- =================================
                            HARGA
                            ================================== --}}

                            <td class="text-end">

                                <span class="money-text">

                                    Rp

                                    {{
                                        number_format(
                                            $penjualan
                                                ->details
                                                ->sum('subtotal'),
                                            0,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </span>

                            </td>



                            {{-- =================================
                            TOTAL
                            ================================== --}}

                            <td class="text-end">

                                <span class="total-text">

                                    Rp

                                    {{
                                        number_format(
                                            $penjualan->total ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        )
                                    }}

                                </span>

                            </td>



                            {{-- =================================
                            STATUS PEMBAYARAN
                            ================================== --}}

                            <td class="text-center">

                                @if(($penjualan->hutang ?? 0) > 0)

                                    <span class="payment-status status-hutang">

                                        HUTANG

                                    </span>

                                @else

                                    <span class="payment-status status-lunas">

                                        LUNAS

                                    </span>

                                @endif

                            </td>



                            {{-- =================================
                            AKSI
                            ================================== --}}

                            <td>

                                <div class="action-buttons">


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route(
                                            'penjualan.show',
                                            $penjualan->id
                                        ) }}"
                                        class="action-btn detail-btn"
                                        title="Lihat Detail"
                                    >

                                        👁️

                                    </a>



                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route(
                                            'penjualan.destroy',
                                            $penjualan->id
                                        ) }}"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirmDelete(
                                            '{{ $penjualan->nomor_nota }}'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="action-btn delete-btn"
                                            title="Hapus"
                                        >

                                            🗑️

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty


                        {{-- =================================
                        DATA KOSONG
                        ================================== --}}

                        <tr>

                            <td
                                colspan="10"
                                class="empty-cell"
                            >

                                <div class="empty-state">


                                    <div class="empty-icon">
                                        📦
                                    </div>


                                    <div class="empty-title">

                                        Belum ada transaksi penjualan

                                    </div>


                                    <div class="empty-text">

                                        Data Stock Out akan muncul
                                        setelah membuat nota.

                                    </div>


                                    <a
                                        href="{{ route('penjualan.create') }}"
                                        class="empty-button"
                                    >

                                        ＋ Buat Nota

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse



                    {{-- =================================
                    SEARCH EMPTY
                    ================================== --}}

                    <tr
                        id="searchEmptyRow"
                        style="display: none;"
                    >

                        <td
                            colspan="10"
                            class="empty-cell"
                        >

                            <div class="search-empty-state">


                                <div class="search-empty-icon">
                                    🔍
                                </div>


                                <div class="empty-title">

                                    Data tidak ditemukan

                                </div>


                                <div class="empty-text">

                                    Tidak ada No. Nota atau Customer
                                    yang cocok.

                                </div>


                                <button
                                    type="button"
                                    class="reset-search-btn"
                                    onclick="resetSearch()"
                                >

                                    Tampilkan Semua

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>



<script>

    document.addEventListener('DOMContentLoaded', function () {


        const searchInput =
            document.getElementById('stockSearch');


        const clearButton =
            document.getElementById('clearSearch');


        const searchInfo =
            document.getElementById('searchInfo');


        const searchEmptyRow =
            document.getElementById('searchEmptyRow');


        const rows =
            document.querySelectorAll(
                '#stockTableBody .stock-row'
            );



        /* =====================================================
           SEARCH
        ====================================================== */

        function performSearch() {


            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();


            let found = 0;



            rows.forEach(function (row) {


                const nota =
                    row.dataset.nota || '';


                const customer =
                    row.dataset.customer || '';



                const match =
                    nota.includes(keyword) ||
                    customer.includes(keyword);



                if (match) {

                    row.style.display = '';

                    found++;

                } else {

                    row.style.display = 'none';

                }

            });



            /* =============================================
               CLEAR BUTTON
            ============================================== */

            if (keyword.length > 0) {

                clearButton.style.display = 'flex';

            } else {

                clearButton.style.display = 'none';

            }



            /* =============================================
               SEARCH INFO
            ============================================== */

            if (keyword.length === 0) {

                searchInfo.textContent =
                    'Menampilkan semua transaksi';

            } else {

                searchInfo.textContent =
                    found + ' transaksi ditemukan';

            }



            /* =============================================
               EMPTY SEARCH
            ============================================== */

            if (
                keyword.length > 0 &&
                found === 0
            ) {

                searchEmptyRow.style.display = '';

            } else {

                searchEmptyRow.style.display = 'none';

            }

        }



        /* =====================================================
           INPUT SEARCH
        ====================================================== */

        searchInput.addEventListener(
            'input',
            performSearch
        );



        /* =====================================================
           CLEAR SEARCH
        ====================================================== */

        clearButton.addEventListener(
            'click',
            function () {

                resetSearch();

            }
        );



        /* =====================================================
           RESET SEARCH
        ====================================================== */

        window.resetSearch = function () {

            searchInput.value = '';

            performSearch();

            searchInput.focus();

        };



        /* =====================================================
           ESCAPE
        ====================================================== */

        searchInput.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    resetSearch();

                }

            }
        );

    });



    /* =========================================================
       CONFIRM DELETE
    ========================================================= */

    function confirmDelete(nomorNota) {

        return confirm(

            'Yakin ingin menghapus nota ' +
            nomorNota +
            '?\n\n' +

            'Data penjualan dan detail barang pada nota ini akan dihapus.'

        );

    }

</script>

@endsection