@extends('layouts.app')

@section('title', 'Stock Out')

@section('content')

<div class="stockout-page">

    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="page-header">

        <div>
            <h3 class="stock-title">
                📤 Stock Out
            </h3>

            <p class="stock-subtitle">
                Daftar barang yang terjual
            </p>
        </div>

        <a
            href="{{ route('penjualan.create') }}"
            class="btn-create"
        >
            <span>＋</span>
            Buat Nota
        </a>

    </div>


    {{-- =========================================================
         SUCCESS
    ========================================================= --}}

    @if(session('success'))

        <div class="alert-custom alert-success-custom">

            <span class="alert-icon">✓</span>

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


    {{-- =========================================================
         ERROR
    ========================================================= --}}

    @if(session('error'))

        <div class="alert-custom alert-danger-custom">

            <span class="alert-icon">⚠</span>

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


    {{-- =========================================================
         TABLE CARD
    ========================================================= --}}

    <div class="stock-card">


        {{-- =====================================================
             SEARCH
        ====================================================== --}}

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

            <div
                id="searchInfo"
                class="search-info"
            >
                Menampilkan semua transaksi
            </div>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

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

                            {{-- =================================================
                                 NO
                            ================================================== --}}

                            <td class="text-center">

                                <span class="number-badge">
                                    {{ $index + 1 }}
                                </span>

                            </td>


                            {{-- =================================================
                                 NO NOTA
                            ================================================== --}}

                            <td>

                                <span class="nota-text">
                                    {{ $penjualan->nomor_nota ?? '-' }}
                                </span>

                            </td>


                            {{-- =================================================
                                 TANGGAL
                            ================================================== --}}

                            <td>

                                @if($penjualan->tanggal_penjualan)

                                    <div class="date-text">
                                        {{ $penjualan->tanggal_penjualan->format('d/m/Y') }}
                                    </div>

                                    <div class="time-text">
                                        {{ $penjualan->tanggal_penjualan->format('H:i') }}
                                    </div>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                 CUSTOMER
                            ================================================== --}}

                            <td>

                                <span
                                    class="customer-text"
                                    title="{{ $penjualan->nama_customer }}"
                                >
                                    {{ $penjualan->nama_customer ?: '-' }}
                                </span>

                            </td>


                            {{-- =================================================
                                 BARANG
                            ================================================== --}}

                            <td class="text-center">

                                <span class="barang-badge">

                                    {{ $penjualan->details->count() }}

                                </span>

                            </td>


                            {{-- =================================================
                                 DISKON
                            ================================================== --}}

                            <td class="text-end">

                                <span class="money-text diskon-text">

                                    {{ number_format(
                                        $penjualan->diskon ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}%

                                </span>

                            </td>


                            {{-- =================================================
                                 HARGA
                            ================================================== --}}

                            <td class="text-end">

                                <span class="money-text">

                                    Rp {{ number_format(
                                        $penjualan->details->sum('subtotal'),
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </td>


                            {{-- =================================================
                                 TOTAL
                            ================================================== --}}

                            <td class="text-end">

                                <span class="total-text">

                                    Rp {{ number_format(
                                        $penjualan->total ?? 0,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </td>


                            {{-- =================================================
                                 AKSI
                            ================================================== --}}

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


                                    {{-- DELETE --}}

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

                        <tr id="emptyDataRow">

                            <td
                                colspan="9"
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
                                        Data Stock Out akan muncul setelah membuat nota.
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


                    {{-- =================================================
                         SEARCH EMPTY
                    ================================================== --}}

                    <tr
                        id="searchEmptyRow"
                        style="display: none;"
                    >

                        <td
                            colspan="9"
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
                                    Tidak ada No. Nota atau Customer yang cocok.
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



{{-- =============================================================
     STYLE
============================================================= --}}

<style>

/* =============================================================
   PAGE
============================================================= */

.stockout-page {

    width: 100%;
    max-width: 100%;

}


/* =============================================================
   HEADER
============================================================= */

.page-header {

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 20px;

    margin-bottom: 22px;

}


.stock-title {

    margin: 0 0 5px 0;

    color: #1e293b;

    font-size: 24px;

    font-weight: 700;

}


.stock-subtitle {

    margin: 0;

    color: #64748b;

    font-size: 14px;

}


.btn-create {

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 5px;

    padding: 10px 16px;

    background: #0d6efd;

    color: #ffffff;

    border-radius: 8px;

    text-decoration: none;

    font-size: 14px;

    font-weight: 600;

    white-space: nowrap;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        background .2s ease;

}


.btn-create:hover {

    color: #ffffff;

    background: #0b5ed7;

    transform: translateY(-2px);

    box-shadow:
        0 6px 16px rgba(13,110,253,.20);

}


.btn-create:active {

    transform: translateY(0);

}



/* =============================================================
   ALERT
============================================================= */

.alert-custom {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 12px 15px;

    margin-bottom: 18px;

    border-radius: 9px;

    font-size: 14px;

    animation: alertIn .35s ease;

}


.alert-success-custom {

    background: #ecfdf5;

    color: #047857;

    border: 1px solid #a7f3d0;

}


.alert-danger-custom {

    background: #fef2f2;

    color: #b91c1c;

    border: 1px solid #fecaca;

}


.alert-icon {

    font-weight: 700;

}


.alert-close {

    margin-left: auto;

    border: none;

    background: transparent;

    color: inherit;

    font-size: 21px;

    cursor: pointer;

    line-height: 1;

    opacity: .65;

}


.alert-close:hover {

    opacity: 1;

}


@keyframes alertIn {

    from {

        opacity: 0;

        transform: translateY(-8px);

    }

    to {

        opacity: 1;

        transform: translateY(0);

    }

}



/* =============================================================
   CARD
============================================================= */

.stock-card {

    width: 100%;

    background: #ffffff;

    border-radius: 12px;

    border: 1px solid #e5e7eb;

    box-shadow:
        0 2px 8px rgba(15,23,42,.04);

    overflow: hidden;

}



/* =============================================================
   SEARCH AREA
============================================================= */

.search-area {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    padding: 16px;

    border-bottom: 1px solid #eef2f7;

    background: #ffffff;

}


.search-box {

    position: relative;

    width: 360px;

    max-width: 100%;

}


.search-icon {

    position: absolute;

    left: 13px;

    top: 50%;

    transform: translateY(-50%);

    font-size: 14px;

    pointer-events: none;

}


.search-input {

    width: 100%;

    height: 40px;

    padding: 0 40px 0 38px;

    border: 1px solid #dbe2ea;

    border-radius: 8px;

    outline: none;

    color: #334155;

    background: #ffffff;

    font-size: 13px;

    transition:
        border-color .2s ease,
        box-shadow .2s ease;

}


.search-input::placeholder {

    color: #94a3b8;

}


.search-input:focus {

    border-color: #86b7fe;

    box-shadow:
        0 0 0 3px rgba(13,110,253,.10);

}


.clear-search {

    position: absolute;

    right: 8px;

    top: 50%;

    transform: translateY(-50%);

    width: 26px;

    height: 26px;

    border: none;

    border-radius: 50%;

    background: transparent;

    color: #94a3b8;

    font-size: 18px;

    cursor: pointer;

    display: none;

    align-items: center;

    justify-content: center;

}


.clear-search:hover {

    background: #f1f5f9;

    color: #334155;

}


.search-info {

    color: #94a3b8;

    font-size: 12px;

    white-space: nowrap;

}



/* =============================================================
   TABLE WRAPPER
============================================================= */

.table-wrapper {

    width: 100%;

    overflow: hidden;

}


/* =============================================================
   TABLE
============================================================= */

.stock-table {

    width: 100%;

    table-layout: fixed;

    border-collapse: collapse;

    margin: 0;

    font-size: 13px;

}


/* =============================================================
   TABLE HEADER
============================================================= */

.stock-table thead th {

    padding: 13px 8px;

    background: #f8fafc;

    color: #475569;

    border-bottom: 1px solid #e2e8f0;

    font-size: 11px;

    font-weight: 700;

    white-space: nowrap;

    vertical-align: middle;

}


/* =============================================================
   TABLE BODY
============================================================= */

.stock-table tbody td {

    padding: 13px 8px;

    border-bottom: 1px solid #f1f5f9;

    color: #334155;

    vertical-align: middle;

}


.stock-table tbody tr:last-child td {

    border-bottom: none;

}



/* =============================================================
   COLUMN WIDTH
   TOTAL = 100%
============================================================= */

.col-no {

    width: 5%;

    text-align: center;

}


.col-nota {

    width: 17%;

}


.col-tanggal {

    width: 12%;

}


.col-customer {

    width: 16%;

}


.col-barang {

    width: 8%;

    text-align: center;

}


.col-diskon {

    width: 10%;

    text-align: right;

}


.col-harga {

    width: 13%;

    text-align: right;

}


.col-total {

    width: 12%;

    text-align: right;

}


.col-aksi {

    width: 7%;

    text-align: center;

}



/* =============================================================
   ROW ANIMATION
============================================================= */

.stock-row {

    position: relative;

    transition:
        background-color .22s ease,
        box-shadow .22s ease,
        transform .22s ease;

    animation: rowAppear .35s ease both;

}


.stock-row:hover {

    background: #f8fbff;

    box-shadow:
        inset 3px 0 0 #0d6efd;

}


.stock-row:hover .number-badge {

    transform: scale(1.08);

}


.stock-row:hover .nota-text {

    color: #0056d6;

}


@keyframes rowAppear {

    from {

        opacity: 0;

        transform: translateY(7px);

    }

    to {

        opacity: 1;

        transform: translateY(0);

    }

}



/* =============================================================
   NUMBER
============================================================= */

.number-badge {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    width: 27px;

    height: 27px;

    border-radius: 50%;

    background: #f1f5f9;

    color: #475569;

    font-size: 11px;

    font-weight: 600;

    transition: transform .2s ease;

}



/* =============================================================
   NO NOTA
============================================================= */

.nota-text {

    display: inline-block;

    color: #0d6efd;

    font-weight: 700;

    font-size: 12px;

    white-space: nowrap;

    letter-spacing: .1px;

}



/* =============================================================
   TANGGAL
============================================================= */

.date-text {

    color: #334155;

    font-size: 12px;

    font-weight: 600;

    white-space: nowrap;

}


.time-text {

    margin-top: 2px;

    color: #94a3b8;

    font-size: 10px;

}



/* =============================================================
   CUSTOMER
============================================================= */

.customer-text {

    display: block;

    color: #334155;

    font-size: 12px;

    font-weight: 500;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}



/* =============================================================
   BARANG
============================================================= */

.barang-badge {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    min-width: 29px;

    height: 28px;

    padding: 0 8px;

    border-radius: 7px;

    background: #eff6ff;

    color: #2563eb;

    border: 1px solid #dbeafe;

    font-size: 11px;

    font-weight: 700;

    transition:
        transform .2s ease,
        background .2s ease;

}


.stock-row:hover .barang-badge {

    transform: translateY(-1px);

    background: #dbeafe;

}



/* =============================================================
   MONEY
============================================================= */

.money-text {

    color: #334155;

    font-size: 11px;

    font-weight: 500;

    white-space: nowrap;

}


.diskon-text {

    color: #64748b;

}


.total-text {

    color: #0d6efd;

    font-size: 11px;

    font-weight: 700;

    white-space: nowrap;

}



/* =============================================================
   ACTION
============================================================= */

.action-buttons {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 4px;

}


.delete-form {

    margin: 0;

    padding: 0;

}


.action-btn {

    width: 30px;

    height: 30px;

    padding: 0;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border-radius: 7px;

    background: #ffffff;

    cursor: pointer;

    font-size: 12px;

    text-decoration: none;

    transition:
        transform .2s ease,
        background .2s ease,
        color .2s ease,
        box-shadow .2s ease;

}


.detail-btn {

    border: 1px solid #bfdbfe;

    color: #2563eb;

}


.detail-btn:hover {

    background: #0d6efd;

    color: #ffffff;

    border-color: #0d6efd;

    transform: translateY(-2px) scale(1.04);

    box-shadow:
        0 4px 10px rgba(13,110,253,.20);

}


.delete-btn {

    border: 1px solid #fecaca;

    color: #dc3545;

}


.delete-btn:hover {

    background: #dc3545;

    color: #ffffff;

    border-color: #dc3545;

    transform: translateY(-2px) scale(1.04);

    box-shadow:
        0 4px 10px rgba(220,53,69,.20);

}


.action-btn:active {

    transform: scale(.94);

}



/* =============================================================
   EMPTY
============================================================= */

.empty-cell {

    padding: 0 !important;

}


.empty-state,
.search-empty-state {

    text-align: center;

    padding: 55px 20px;

}


.empty-icon,
.search-empty-icon {

    font-size: 40px;

    margin-bottom: 12px;

}


.search-empty-icon {

    filter: grayscale(.2);

}


.empty-title {

    color: #334155;

    font-size: 14px;

    font-weight: 700;

    margin-bottom: 5px;

}


.empty-text {

    color: #94a3b8;

    font-size: 12px;

    margin-bottom: 18px;

}


.empty-button,
.reset-search-btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    padding: 8px 13px;

    border: none;

    border-radius: 7px;

    background: #0d6efd;

    color: #ffffff;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;

    transition:
        transform .2s ease,
        box-shadow .2s ease;

}


.empty-button:hover,
.reset-search-btn:hover {

    color: #ffffff;

    transform: translateY(-2px);

    box-shadow:
        0 4px 12px rgba(13,110,253,.20);

}



/* =============================================================
   TABLET
============================================================= */

@media (max-width: 1100px) {

    .stock-table {

        font-size: 12px;

    }


    .stock-table thead th {

        padding: 12px 5px;

        font-size: 10px;

    }


    .stock-table tbody td {

        padding: 12px 5px;

    }


    .nota-text {

        font-size: 10px;

    }


    .money-text,
    .total-text {

        font-size: 10px;

    }


    .customer-text,
    .date-text {

        font-size: 10px;

    }


    .action-btn {

        width: 28px;

        height: 28px;

        font-size: 11px;

    }

}



/* =============================================================
   LAYAR KECIL
============================================================= */

@media (max-width: 850px) {

    .page-header {

        align-items: flex-start;

    }


    .stock-title {

        font-size: 21px;

    }


    .stock-table thead th {

        font-size: 9px;

        padding: 10px 3px;

    }


    .stock-table tbody td {

        padding: 10px 3px;

    }


    .nota-text {

        font-size: 9px;

    }


    .date-text,
    .customer-text,
    .money-text,
    .total-text {

        font-size: 9px;

    }


    .number-badge {

        width: 24px;

        height: 24px;

        font-size: 9px;

    }


    .barang-badge {

        min-width: 24px;

        height: 25px;

        padding: 0 5px;

        font-size: 9px;

    }


    .action-btn {

        width: 25px;

        height: 25px;

        font-size: 9px;

    }

}



/* =============================================================
   MOBILE
============================================================= */

@media (max-width: 650px) {

    .page-header {

        flex-direction: column;

        align-items: stretch;

        gap: 12px;

    }


    .btn-create {

        width: 100%;

    }


    .search-area {

        flex-direction: column;

        align-items: stretch;

    }


    .search-box {

        width: 100%;

    }


    .search-info {

        text-align: left;

    }


    /*
     * Tetap TIDAK menggunakan overflow-x.
     * Tabel dipaksa tetap masuk layar.
     */

    .stock-table {

        font-size: 8px;

    }


    .stock-table thead th {

        padding: 8px 2px;

        font-size: 8px;

    }


    .stock-table tbody td {

        padding: 8px 2px;

    }


    .nota-text {

        font-size: 8px;

        letter-spacing: 0;

    }


    .date-text,
    .customer-text,
    .money-text,
    .total-text {

        font-size: 8px;

    }


    .time-text {

        font-size: 7px;

    }


    .number-badge {

        width: 21px;

        height: 21px;

        font-size: 8px;

    }


    .barang-badge {

        min-width: 21px;

        height: 22px;

        padding: 0 3px;

        font-size: 8px;

    }


    .action-buttons {

        gap: 2px;

    }


    .action-btn {

        width: 22px;

        height: 22px;

        font-size: 8px;

        border-radius: 5px;

    }

}



/* =============================================================
   EXTRA SMALL
============================================================= */

@media (max-width: 430px) {

    .stock-title {

        font-size: 19px;

    }


    .stock-subtitle {

        font-size: 12px;

    }


    .btn-create {

        font-size: 12px;

        padding: 9px 12px;

    }


    .stock-table thead th {

        font-size: 7px;

        padding: 7px 1px;

    }


    .stock-table tbody td {

        padding: 7px 1px;

    }


    .nota-text {

        font-size: 7px;

    }


    .date-text,
    .customer-text,
    .money-text,
    .total-text {

        font-size: 7px;

    }


    .time-text {

        font-size: 6px;

    }


    .number-badge {

        width: 19px;

        height: 19px;

        font-size: 7px;

    }


    .barang-badge {

        min-width: 19px;

        height: 20px;

        font-size: 7px;

    }


    .action-btn {

        width: 20px;

        height: 20px;

        font-size: 7px;

    }

}

</style>



{{-- =============================================================
     JAVASCRIPT SEARCH
============================================================= --}}

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
        document.querySelectorAll('.stock-row');


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


        /*
         * Tampilkan tombol clear
         */

        if (keyword.length > 0) {

            clearButton.style.display = 'flex';

        } else {

            clearButton.style.display = 'none';

        }


        /*
         * Informasi hasil pencarian
         */

        if (keyword.length === 0) {

            searchInfo.textContent =
                'Menampilkan semua transaksi';

        } else {

            searchInfo.textContent =
                found + ' transaksi ditemukan';

        }


        /*
         * Kalau tidak ditemukan
         */

        if (
            keyword.length > 0 &&
            found === 0
        ) {

            searchEmptyRow.style.display = '';

        } else {

            searchEmptyRow.style.display = 'none';

        }

    }


    searchInput.addEventListener(
        'input',
        performSearch
    );


    clearButton.addEventListener(
        'click',
        function () {

            resetSearch();

        }
    );


    window.resetSearch = function () {

        searchInput.value = '';

        performSearch();

        searchInput.focus();

    };


    /*
     * Keyboard shortcut ESC
     */

    searchInput.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                resetSearch();

            }

        }
    );

});


/* =============================================================
   DELETE CONFIRMATION
============================================================= */

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