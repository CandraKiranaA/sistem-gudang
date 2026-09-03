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


                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                    {{-- JUMLAH DATA --}}
                    @if($barangMasuks->total() > 0)

                        <div class="data-count">

                            <span class="count-number">
                                {{ $barangMasuks->total() }}
                            </span>

                            <span class="count-label">
                                Data
                            </span>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- BUTTON HAPUS TERPILIH --}}
                    {{-- ================================================= --}}

                    <button
                        type="button"
                        id="bulkDeleteButton"
                        class="btn btn-danger bulk-delete-btn"
                        disabled
                    >
                        🗑️
                        <span id="bulkDeleteText">
                            Hapus Terpilih
                        </span>
                    </button>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- FORM BULK DELETE --}}
        {{-- ================================================= --}}

        <form
            id="bulkDeleteForm"
            action="{{ route('barang-masuk.bulkDelete') }}"
            method="POST"
        >

            @csrf

            @method('DELETE')


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

                                {{-- CHECKBOX --}}
                                <th
                                    class="text-center col-check"
                                >

                                    <div class="checkbox-wrapper">

                                        <input
                                            type="checkbox"
                                            id="checkAll"
                                            class="form-check-input row-checkbox"
                                            title="Pilih semua data di halaman ini"
                                        >

                                    </div>

                                </th>


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
                                    {{-- CHECKBOX --}}
                                    {{-- ================================================= --}}

                                    <td class="text-center">

                                        <div class="checkbox-wrapper">

                                            <input
                                                type="checkbox"
                                                name="ids[]"
                                                value="{{ $item->id }}"
                                                class="form-check-input row-checkbox item-checkbox"
                                            >

                                        </div>

                                    </td>


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


                                            <div class="date-main">

                                                {{ $tanggal->format('d M Y') }}

                                            </div>


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

                                                {{ number_format(
                                                    $item->jumlah_koli ?? 0
                                                ) }}

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

                                                {{ number_format(
                                                    $item->jumlah_pcs ?? 0
                                                ) }}

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

                                            {{-- EDIT --}}

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


                                            {{-- DELETE SATU DATA --}}

                                            <button
                                                type="button"
                                                class="action-btn delete-btn"
                                                title="Hapus data"
                                                onclick="confirmSingleDelete(
                                                    '{{ route('barang-masuk.destroy', $item) }}'
                                                )"
                                            >
                                                🗑️
                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- ================================================= --}}
                                {{-- EMPTY --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        colspan="11"
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

        </form>
{{-- ================================================= --}}
{{-- PAGINATION --}}
{{-- ================================================= --}}

@if($barangMasuks->hasPages())

<div class="pagination-container">

    {{-- INFO --}}
    <div class="pagination-info">

        Menampilkan
        <strong>{{ $barangMasuks->firstItem() }}</strong>
        sampai
        <strong>{{ $barangMasuks->lastItem() }}</strong>
        dari
        <strong>{{ $barangMasuks->total() }}</strong>
        data

    </div>


    {{-- PAGINATION --}}
    <div class="custom-pagination">

        {{-- PREVIOUS --}}
        @if ($barangMasuks->onFirstPage())

            <span class="pagination-btn disabled">
                ‹
            </span>

        @else

            <a
                href="{{ $barangMasuks->previousPageUrl() }}"
                class="pagination-btn"
            >
                ‹
            </a>

        @endif


        {{-- NOMOR HALAMAN --}}
        @foreach ($barangMasuks->getUrlRange(1, $barangMasuks->lastPage()) as $page => $url)

            @if ($page == $barangMasuks->currentPage())

                <span class="pagination-btn active">
                    {{ $page }}
                </span>

            @else

                <a
                    href="{{ $url }}"
                    class="pagination-btn"
                >
                    {{ $page }}
                </a>

            @endif

        @endforeach


        {{-- NEXT --}}
        @if ($barangMasuks->hasMorePages())

            <a
                href="{{ $barangMasuks->nextPageUrl() }}"
                class="pagination-btn"
            >
                ›
            </a>

        @else

            <span class="pagination-btn disabled">
                ›
            </span>

        @endif

    </div>

</div>

@endif

{{-- ========================================================= --}}
{{-- FORM DELETE SATU DATA --}}
{{-- ========================================================= --}}

<form
    id="singleDeleteForm"
    method="POST"
    style="display:none;"
>
    @csrf
    @method('DELETE')
</form>


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
   BULK DELETE
========================================================= */

.bulk-delete-btn {

    padding: 8px 14px;

    font-size: 13px;

    font-weight: 600;

    white-space: nowrap;

    transition: all 0.2s ease;

}

.bulk-delete-btn:disabled {

    opacity: 0.45;

    cursor: not-allowed;

}

.bulk-delete-btn:not(:disabled):hover {

    transform: translateY(-1px);

}


/* =========================================================
   CHECKBOX
========================================================= */

.checkbox-wrapper {

    display: flex;

    align-items: center;

    justify-content: center;

}

.row-checkbox {

    width: 18px;

    height: 18px;

    margin: 0;

    cursor: pointer;

    border-radius: 5px;

}

.row-checkbox:focus {

    box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.12);

}

.item-checkbox:checked {

    background-color: #0d6efd;

    border-color: #0d6efd;

}

#checkAll:checked {

    background-color: #0d6efd;

    border-color: #0d6efd;

}


/* =========================================================
   TABLE UTAMA
========================================================= */

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

    transition:
        background-color 0.15s ease;

}

.modern-table tbody tr:hover {

    background: #f8fbff;

}

.modern-table tbody tr:last-child td {

    border-bottom: 0;

}


/* =========================================================
   SELECTED ROW
========================================================= */

.modern-table tbody tr.selected-row {

    background: #eef6ff;

}

.modern-table tbody tr.selected-row td {

    border-bottom-color: #dbeafe;

}


/* =========================================================
   LEBAR KOLOM
========================================================= */

.col-check {

    width: 4%;

}

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

.pagination-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-top: 1px solid #e5e7eb;
    background: #ffffff;
}


/* =========================================================
   INFO
========================================================= */

.pagination-info {
    font-size: 13px;
    color: #64748b;
    white-space: nowrap;
}

.pagination-info strong {
    color: #334155;
    font-weight: 700;
}


/* =========================================================
   PAGINATION WRAPPER
========================================================= */

.custom-pagination {
    display: flex;
    align-items: center;
    gap: 5px;
    margin: 0;
    padding: 0;
}


/* =========================================================
   BUTTON
========================================================= */

.pagination-btn {
    width: 36px;
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;
    margin: 0;

    border: 1px solid #e2e8f0;
    border-radius: 7px;

    background: #ffffff;
    color: #475569;

    text-decoration: none;

    font-size: 14px;
    font-weight: 600;

    line-height: 1;

    box-sizing: border-box;

    transition: all 0.15s ease;
}


/* =========================================================
   HOVER
========================================================= */

.pagination-btn:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #0d6efd;
    text-decoration: none;
}


/* =========================================================
   ACTIVE
========================================================= */

.pagination-btn.active {
    background: #0d6efd;
    border-color: #0d6efd;
    color: #ffffff;
}


/* =========================================================
   DISABLED
========================================================= */

.pagination-btn.disabled {
    background: #f8fafc;
    color: #cbd5e1;
    border-color: #e2e8f0;
    cursor: default;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .pagination-container {
        flex-direction: column;
        gap: 12px;
        padding: 16px;
    }

    .pagination-info {
        text-align: center;
        white-space: normal;
    }

    .custom-pagination {
        justify-content: center;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .pagination-btn {
        width: 34px;
        height: 34px;
        font-size: 13px;
    }

    .custom-pagination {
        gap: 4px;
    }

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
    | karena banyak kolom.
    */

    .modern-table {

        min-width: 1100px;

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

    .bulk-delete-btn {

        width: 100%;

    }

}


/* =========================================================
   EXTRA SMALL
========================================================= */

@media (max-width: 480px) {

    .modern-table {

        min-width: 1050px;

    }

}

</style>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const checkAll =
        document.getElementById('checkAll');

    const itemCheckboxes =
        document.querySelectorAll('.item-checkbox');

    const bulkDeleteButton =
        document.getElementById('bulkDeleteButton');

    const bulkDeleteText =
        document.getElementById('bulkDeleteText');

    const bulkDeleteForm =
        document.getElementById('bulkDeleteForm');


    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS TOMBOL HAPUS
    |--------------------------------------------------------------------------
    */

    function updateBulkDeleteButton() {

        const checkedItems =
            document.querySelectorAll(
                '.item-checkbox:checked'
            );

        const jumlah =
            checkedItems.length;


        /*
        |--------------------------------------------------------------------------
        | Tombol aktif jika ada minimal 1 checkbox
        |--------------------------------------------------------------------------
        */

        bulkDeleteButton.disabled =
            jumlah === 0;


        /*
        |--------------------------------------------------------------------------
        | Ubah tulisan tombol
        |--------------------------------------------------------------------------
        */

        if (jumlah > 0) {

            bulkDeleteText.textContent =
                'Hapus ' + jumlah + ' Data';

        } else {

            bulkDeleteText.textContent =
                'Hapus Terpilih';

        }


        /*
        |--------------------------------------------------------------------------
        | Tandai baris yang dipilih
        |--------------------------------------------------------------------------
        */

        itemCheckboxes.forEach(function (checkbox) {

            const row =
                checkbox.closest('tr');

            if (!row) {
                return;
            }

            if (checkbox.checked) {

                row.classList.add(
                    'selected-row'
                );

            } else {

                row.classList.remove(
                    'selected-row'
                );

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Update checkbox "Pilih Semua"
        |--------------------------------------------------------------------------
        */

        if (itemCheckboxes.length === 0) {

            checkAll.checked = false;

            checkAll.indeterminate = false;

            return;

        }


        const checkedCount =
            document.querySelectorAll(
                '.item-checkbox:checked'
            ).length;


        if (checkedCount === itemCheckboxes.length) {

            checkAll.checked = true;

            checkAll.indeterminate = false;

        } else if (checkedCount > 0) {

            checkAll.checked = false;

            checkAll.indeterminate = true;

        } else {

            checkAll.checked = false;

            checkAll.indeterminate = false;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CHECKBOX PILIH SEMUA
    |--------------------------------------------------------------------------
    */

    if (checkAll) {

        checkAll.addEventListener(
            'change',
            function () {

                itemCheckboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            checkAll.checked;

                    }
                );


                updateBulkDeleteButton();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CHECKBOX PER BARIS
    |--------------------------------------------------------------------------
    */

    itemCheckboxes.forEach(
        function (checkbox) {

            checkbox.addEventListener(
                'change',
                function () {

                    updateBulkDeleteButton();

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | HAPUS BANYAK DATA
    |--------------------------------------------------------------------------
    */

    if (bulkDeleteButton) {

        bulkDeleteButton.addEventListener(
            'click',
            function () {

                const checkedItems =
                    document.querySelectorAll(
                        '.item-checkbox:checked'
                    );


                const jumlah =
                    checkedItems.length;


                /*
                |--------------------------------------------------------------------------
                | Tidak ada data dipilih
                |--------------------------------------------------------------------------
                */

                if (jumlah === 0) {

                    alert(
                        'Silakan pilih minimal satu data yang ingin dihapus.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Konfirmasi
                |--------------------------------------------------------------------------
                */

                const konfirmasi = confirm(

                    'Apakah kamu yakin ingin menghapus ' +
                    jumlah +
                    ' data barang masuk yang dipilih?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'

                );


                if (!konfirmasi) {

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Submit form
                |--------------------------------------------------------------------------
                */

                bulkDeleteForm.submit();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE SATU DATA
    |--------------------------------------------------------------------------
    */

    window.confirmSingleDelete =
        function (url) {

            const konfirmasi =
                confirm(
                    'Apakah kamu yakin ingin menghapus data ini?'
                );


            if (!konfirmasi) {

                return;

            }


            const form =
                document.getElementById(
                    'singleDeleteForm'
                );


            form.action = url;

            form.submit();

        };


    /*
    |--------------------------------------------------------------------------
    | INIT
    |--------------------------------------------------------------------------
    */

    updateBulkDeleteButton();

});

</script>

@endsection
