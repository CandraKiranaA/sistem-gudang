@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <div class="page-icon">
                    📦
                </div>

                <h3 class="fw-bold mb-0 text-dark">
                    Barang Masuk
                </h3>

            </div>

            <p class="text-muted mb-0 ms-1">
                Kelola dan pantau data barang yang masuk ke gudang.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- BUTTON HEADER --}}
        {{-- ================================================= --}}

        <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">

            <a
                href="{{ route('barang-masuk.import.form') }}"
                class="btn btn-outline-success btn-header"
            >
                <span class="me-1">📥</span>
                Import
            </a>

            <a
                href="{{ route('barang-masuk.export') }}"
                class="btn btn-outline-primary btn-header"
            >
                <span class="me-1">📤</span>
                Export
            </a>

            <a
                href="{{ route('barang-masuk.create') }}"
                class="btn btn-primary btn-add"
            >
                <span class="me-1">＋</span>
                Tambah Barang
            </a>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- SUCCESS --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show custom-alert"
            role="alert"
        >

            <div class="d-flex align-items-center">

                <div class="alert-icon success-icon">
                    ✓
                </div>

                <div>

                    <strong>Berhasil!</strong>

                    <div>
                        {{ session('success') }}
                    </div>

                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show custom-alert"
            role="alert"
        >

            <div class="d-flex align-items-center">

                <div class="alert-icon danger-icon">
                    !
                </div>

                <div>

                    <strong>Gagal!</strong>

                    <div>
                        {{ session('error') }}
                    </div>

                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- VALIDATION ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger custom-alert">

            <div class="d-flex">

                <div class="alert-icon danger-icon me-3">
                    !
                </div>

                <div>

                    <strong>
                        Terjadi kesalahan
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- SEARCH --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm search-card mb-3">

        <div class="card-body p-3">

            <form
                action="{{ route('barang-masuk.index') }}"
                method="GET"
            >

                <div class="row g-2 align-items-center">

                    <div class="col-md-7 col-lg-5">

                        <div class="search-wrapper">

                            <span class="search-icon">
                                🔍
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control search-input"
                                placeholder="Cari berdasarkan nama barang..."
                                value="{{ request('search') }}"
                            >

                        </div>

                    </div>


                    <div class="col-auto">

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >
                            Cari
                        </button>

                    </div>


                    @if(request('search'))

                        <div class="col-auto">

                            <a
                                href="{{ route('barang-masuk.index') }}"
                                class="btn btn-light border px-3"
                            >
                                Reset
                            </a>

                        </div>

                    @endif

                </div>

            </form>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- TABLE CARD --}}
    {{-- ===================================================== --}}

    <div class="card border-0 shadow-sm table-card">


        {{-- ================================================= --}}
        {{-- TABLE HEADER --}}
        {{-- ================================================= --}}

        <div class="card-header bg-white border-0 px-3 px-md-4 py-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1 table-title">
                        Daftar Barang Masuk
                    </h5>

                    <small class="text-muted table-description">
                        Data barang yang telah dicatat ke dalam sistem.
                    </small>

                </div>


                @if($barangMasuks->total() > 0)

                    <div class="data-count mt-2 mt-md-0">

                        <span class="count-number">
                            {{ $barangMasuks->total() }}
                        </span>

                        <span class="count-label">
                            Data
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TABLE --}}
        {{-- ================================================= --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table align-middle mb-0 modern-table"
                >

                    <thead>

                        <tr>

                            {{-- NO --}}
                            <th
                                class="text-center col-no"
                            >
                                No
                            </th>


                            {{-- TANGGAL --}}
                            <th class="col-tanggal">
                                Tanggal
                            </th>


                            {{-- BARANG --}}
                            <th class="col-barang">
                                Barang
                            </th>


                            {{-- EDISI --}}
                            <th class="text-center col-edisi">
                                Edisi
                            </th>


                            {{-- KOLI --}}
                            <th class="text-center col-jumlah">
                                Koli
                            </th>


                            {{-- PCS --}}
                            <th class="text-center col-jumlah">
                                PCS
                            </th>


                            {{-- HARGA BELI --}}
                            <th class="text-end col-harga">
                                Beli / Koli
                            </th>


                            {{-- HARGA JUAL KOLI --}}
                            <th class="text-end col-harga">
                                Jual / Koli
                            </th>


                            {{-- HARGA JUAL PCS --}}
                            <th class="text-end col-harga">
                                Jual / PCS
                            </th>


                            {{-- AKSI --}}
                            <th class="text-center col-aksi">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($barangMasuks as $item)

                            <tr>

                                {{-- ================================================= --}}
                                {{-- NO --}}
                                {{-- ================================================= --}}

                                <td class="text-center">

                                    <span class="row-number">
                                        {{ $barangMasuks->firstItem() + $loop->index }}
                                    </span>

                                </td>


                                {{-- ================================================= --}}
                                {{-- TANGGAL --}}
                                {{-- ================================================= --}}

                                <td class="date-column">

                                    @if($item->tanggal_input)

                                        @php
                                            $tanggal = \Carbon\Carbon::parse(
                                                $item->tanggal_input
                                            );
                                        @endphp

                                        {{-- TANGGAL UTAMA SATU BARIS --}}
                                        <div class="date-main">

                                            {{ $tanggal->format('d M Y') }}

                                        </div>

                                        {{-- TANGGAL FORMAT DATABASE --}}
                                        <div class="date-sub">

                                            {{ $tanggal->format('Y-m-d') }}

                                        </div>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================= --}}
                                {{-- BARANG --}}
                                {{-- ================================================= --}}

                                <td>

                                    @if($item->barang)

                                        <div class="product-name">

                                            {{ $item->barang->nama_barang }}

                                        </div>


                                        @if($item->barang->satuan)

                                            <div class="product-unit">

                                                {{ strtoupper($item->barang->satuan) }}

                                            </div>

                                        @endif

                                    @else

                                        <span class="text-danger product-not-found">

                                            Barang tidak ditemukan

                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================= --}}
                                {{-- EDISI --}}
                                {{-- ================================================= --}}

                                <td class="text-center">

                                    @if($item->edisi)

                                        <span class="edition-badge">

                                            {{ $item->edisi }}

                                        </span>

                                    @else

                                        <span class="no-data">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- ================================================= --}}
                                {{-- KOLI --}}
                                {{-- ================================================= --}}

                                <td class="text-center">

                                    <div class="quantity-box">

                                        <strong>
                                            {{ number_format($item->jumlah_koli ?? 0) }}
                                        </strong>

                                        <small>
                                            Koli
                                        </small>

                                    </div>

                                </td>


                                {{-- ================================================= --}}
                                {{-- PCS --}}
                                {{-- ================================================= --}}

                                <td class="text-center">

                                    <div class="quantity-box pcs-box">

                                        <strong>
                                            {{ number_format($item->jumlah_pcs ?? 0) }}
                                        </strong>

                                        <small>
                                            PCS
                                        </small>

                                    </div>

                                </td>


                                {{-- ================================================= --}}
                                {{-- HARGA BELI --}}
                                {{-- ================================================= --}}

                                <td class="text-end price-column">

                                    <span class="currency-label">
                                        Rp
                                    </span>

                                    <strong class="price-text">

                                        {{ number_format(
                                            $item->harga_beli_koli ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>


                                {{-- ================================================= --}}
                                {{-- HARGA JUAL KOLI --}}
                                {{-- ================================================= --}}

                                <td class="text-end price-column">

                                    <span class="currency-label">
                                        Rp
                                    </span>

                                    <strong class="price-text">

                                        {{ number_format(
                                            $item->harga_jual_koli ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>


                                {{-- ================================================= --}}
                                {{-- HARGA JUAL PCS --}}
                                {{-- ================================================= --}}

                                <td class="text-end price-column">

                                    <span class="currency-label">
                                        Rp
                                    </span>

                                    <strong class="price-text">

                                        {{ number_format(
                                            $item->harga_jual_pcs ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </strong>

                                </td>


                                {{-- ================================================= --}}
                                {{-- AKSI --}}
                                {{-- ================================================= --}}

                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="{{ route(
                                                'barang-masuk.edit',
                                                $item
                                            ) }}"
                                            class="action-btn edit-btn"
                                            title="Edit data"
                                        >
                                            ✏️
                                        </a>


                                        <form
                                            action="{{ route(
                                                'barang-masuk.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Apakah kamu yakin ingin menghapus data ini?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="Hapus data"
                                            >
                                                🗑️
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- ================================================= --}}
                            {{-- EMPTY --}}
                            {{-- ================================================= --}}

                            <tr>

                                <td
                                    colspan="10"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">
                                        📦
                                    </div>

                                    <h6 class="fw-bold mb-1">
                                        Belum Ada Data Barang Masuk
                                    </h6>

                                    <p class="text-muted mb-3">
                                        Belum ada barang yang tercatat
                                        sebagai barang masuk.
                                    </p>

                                    <a
                                        href="{{ route('barang-masuk.create') }}"
                                        class="btn btn-primary btn-sm px-3"
                                    >
                                        ＋ Tambah Barang
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($barangMasuks->hasPages())

            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center">

                    <div>

                        <small class="pagination-info">

                            Menampilkan

                            <strong>
                                {{ $barangMasuks->firstItem() }}
                            </strong>

                            sampai

                            <strong>
                                {{ $barangMasuks->lastItem() }}
                            </strong>

                            dari

                            <strong>
                                {{ $barangMasuks->total() }}
                            </strong>

                            data

                        </small>

                    </div>


                    <div class="mt-2 mt-md-0">

                        {{ $barangMasuks->withQueryString()->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

<style>

/* =========================================================
   GENERAL
========================================================= */

.page-icon {

    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef5ff;

    border-radius: 10px;

    font-size: 21px;

}

.btn {

    border-radius: 8px;

}


/* =========================================================
   HEADER BUTTON
========================================================= */

.btn-header {

    padding: 10px 16px;

    font-size: 14px;

    font-weight: 600;

    transition: all 0.2s ease;

}

.btn-header:hover {

    transform: translateY(-1px);

}

.btn-add {

    padding: 10px 18px;

    font-size: 14px;

    font-weight: 600;

    box-shadow:
        0 3px 10px rgba(13, 110, 253, 0.15);

    transition: all 0.2s ease;

}

.btn-add:hover {

    transform: translateY(-1px);

}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {

    border: 0;

    border-radius: 10px;

    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.04);

}

.alert-icon {

    width: 36px;
    height: 36px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 12px;

    font-weight: 700;

}

.success-icon {

    background: #d1e7dd;

    color: #146c43;

}

.danger-icon {

    background: #f8d7da;

    color: #b02a37;

}


/* =========================================================
   SEARCH
========================================================= */

.search-card {

    border-radius: 10px;

}

.search-wrapper {

    position: relative;

}

.search-icon {

    position: absolute;

    left: 13px;

    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    font-size: 15px;

    opacity: 0.65;

}

.search-input {

    padding-left: 40px;

    height: 44px;

    border-radius: 8px;

    font-size: 14px;

}

.search-input:focus {

    box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.08);

}


/* =========================================================
   TABLE CARD
========================================================= */

.table-card {

    border-radius: 12px;

    overflow: hidden;

}

.table-title {

    font-size: 19px;

}

.table-description {

    font-size: 13px;

}

.data-count {

    background: #f1f5f9;

    padding: 7px 13px;

    border-radius: 20px;

    font-size: 13px;

}

.count-number {

    font-weight: 700;

    color: #0d6efd;

}

.count-label {

    color: #6c757d;

    margin-left: 3px;

}


/* =========================================================
   TABLE UTAMA
========================================================= */

/*
|--------------------------------------------------------------------------
| PENTING
|--------------------------------------------------------------------------
| Tidak menggunakan min-width besar.
| Tabel mengikuti lebar card.
|
*/

.modern-table {

    width: 100%;

    font-size: 15px;

    table-layout: fixed;

}


/* =========================================================
   HEADER TABLE
========================================================= */

.modern-table thead {

    background: #f8fafc;

}

.modern-table thead th {

    color: #475569;

    font-size: 13px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 0.2px;

    padding: 15px 10px;

    border-bottom: 1px solid #e9ecef;

    white-space: nowrap;

    vertical-align: middle;

}


/* =========================================================
   BODY TABLE
========================================================= */

.modern-table tbody td {

    padding: 16px 10px;

    border-bottom: 1px solid #f1f3f5;

    vertical-align: middle;

    font-size: 15px;

    color: #334155;

}

.modern-table tbody tr {

    transition: background-color 0.15s ease;

}

.modern-table tbody tr:hover {

    background: #f8fbff;

}

.modern-table tbody tr:last-child td {

    border-bottom: 0;

}


/* =========================================================
   LEBAR KOLOM
========================================================= */

.col-no {

    width: 6%;

}

.col-tanggal {

    width: 12%;

}

.col-barang {

    width: 18%;

}

.col-edisi {

    width: 10%;

}

.col-jumlah {

    width: 9%;

}

.col-harga {

    width: 12%;

}

.col-aksi {

    width: 8%;

}


/* =========================================================
   NOMOR
========================================================= */

.row-number {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    width: 32px;

    height: 32px;

    background: #f1f5f9;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 600;

    color: #64748b;

}


/* =========================================================
   TANGGAL
========================================================= */

.date-column {

    white-space: nowrap !important;

    overflow: visible;

}

.date-main {

    display: block;

    white-space: nowrap !important;

    font-size: 15px;

    font-weight: 700;

    color: #334155;

    line-height: 1.3;

}

.date-sub {

    display: block;

    white-space: nowrap !important;

    font-size: 11px;

    color: #94a3b8;

    margin-top: 3px;

}


/* =========================================================
   BARANG
========================================================= */

.product-name {

    font-size: 15px;

    font-weight: 700;

    color: #1e293b;

    line-height: 1.35;

    white-space: normal;

    overflow-wrap: break-word;

}

.product-unit {

    margin-top: 3px;

    color: #64748b;

    font-size: 12px;

    font-weight: 500;

}

.product-not-found {

    font-size: 14px;

    font-weight: 600;

}


/* =========================================================
   EDISI
========================================================= */

.edition-badge {

    display: inline-block;

    padding: 5px 8px;

    background: #eef2ff;

    color: #4f46e5;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 600;

    max-width: 100%;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;

}

.no-data {

    font-size: 15px;

}


/* =========================================================
   QUANTITY
========================================================= */

.quantity-box {

    display: inline-flex;

    align-items: baseline;

    justify-content: center;

    gap: 4px;

    padding: 6px 8px;

    background: #f8fafc;

    border-radius: 8px;

    white-space: nowrap;

}

.quantity-box strong {

    font-size: 15px;

    color: #334155;

}

.quantity-box small {

    font-size: 10px;

    color: #94a3b8;

    font-weight: 700;

}

.pcs-box {

    background: #eef6ff;

}

.pcs-box strong {

    color: #0d6efd;

}


/* =========================================================
   HARGA
========================================================= */

.price-column {

    white-space: nowrap;

}

.currency-label {

    font-size: 11px;

    color: #64748b;

    margin-right: 2px;

    font-weight: 500;

}

.price-text {

    font-size: 14px;

    color: #334155;

    font-weight: 700;

    white-space: nowrap;

}


/* =========================================================
   ACTION
========================================================= */

.action-buttons {

    display: flex;

    justify-content: center;

    align-items: center;

    gap: 5px;

}

.action-btn {

    width: 34px;

    height: 34px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border: 0;

    border-radius: 8px;

    text-decoration: none;

    transition: all 0.15s ease;

    font-size: 14px;

}

.edit-btn {

    background: #fff3cd;

}

.edit-btn:hover {

    background: #ffc107;

    transform: translateY(-1px);

}

.delete-btn {

    background: #f8d7da;

}

.delete-btn:hover {

    background: #dc3545;

    transform: translateY(-1px);

}


/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {

    text-align: center;

    padding: 65px 20px !important;

}

.empty-icon {

    width: 70px;

    height: 70px;

    display: flex;

    align-items: center;

    justify-content: center;

    margin: 0 auto 15px;

    background: #f1f5f9;

    border-radius: 50%;

    font-size: 31px;

}

.empty-state h6 {

    font-size: 16px;

}

.empty-state p {

    font-size: 14px;

}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-info {

    font-size: 13px;

    color: #64748b;

}

.pagination-info strong {

    color: #334155;

}

.card-footer .pagination {

    margin-bottom: 0;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .modern-table {

        font-size: 14px;

    }

    .modern-table thead th {

        font-size: 12px;

        padding: 13px 8px;

    }

    .modern-table tbody td {

        font-size: 14px;

        padding: 14px 8px;

    }

    .date-main {

        font-size: 14px;

    }

    .product-name {

        font-size: 14px;

    }

    .price-text {

        font-size: 13px;

    }

    .quantity-box strong {

        font-size: 14px;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .container-fluid {

        padding-left: 12px !important;

        padding-right: 12px !important;

    }

    .btn-header,
    .btn-add {

        flex: 1;

        text-align: center;

    }

    .search-wrapper {

        width: 100%;

    }

    .search-card .col-auto {

        width: auto;

    }

    /*
    | Pada layar kecil tabel tetap bisa digeser horizontal
    | karena 10 kolom memang tidak mungkin semuanya muat.
    */

    .modern-table {

        min-width: 1050px;

        table-layout: fixed;

    }

    .modern-table thead th {

        font-size: 12px;

        padding: 13px 9px;

    }

    .modern-table tbody td {

        font-size: 14px;

        padding: 14px 9px;

    }

    .date-main {

        font-size: 14px;

    }

    .date-sub {

        font-size: 10px;

    }

    .product-name {

        font-size: 14px;

    }

    .quantity-box strong {

        font-size: 14px;

    }

    .price-text {

        font-size: 13px;

    }

}


/* =========================================================
   EXTRA SMALL
========================================================= */

@media (max-width: 480px) {

    .modern-table {

        min-width: 1000px;

    }

}

</style>

@endsection