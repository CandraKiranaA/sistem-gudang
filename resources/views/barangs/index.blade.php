@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')

<div class="container-fluid px-3 px-md-4 py-3">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <div class="page-icon">
                    📦
                </div>

                <h3 class="fw-bold mb-0 text-dark">
                    Master Barang
                </h3>

            </div>

            <p class="text-muted mb-0 ms-1">
                Kelola data barang yang tersedia di gudang.
            </p>

        </div>


        {{-- =================================================
             BUTTON HEADER
        ================================================== --}}

        <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">

            {{-- IMPORT --}}

            <a
                href="{{ route('barangs.import.form') }}"
                class="btn btn-outline-success btn-header"
            >
                <span class="me-1">📥</span>
                Import
            </a>


            {{-- EXPORT --}}

            <a
                href="{{ route('barangs.export') }}"
                class="btn btn-outline-primary btn-header"
            >
                <span class="me-1">📤</span>
                Export
            </a>


            {{-- TAMBAH BARANG --}}

            <a
                href="{{ route('barangs.create') }}"
                class="btn btn-primary btn-add"
            >
                <span class="me-1">＋</span>
                Tambah Barang
            </a>

        </div>

    </div>


    {{-- =====================================================
         NOTIFIKASI SUCCESS
    ====================================================== --}}

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

                    <strong>
                        Berhasil!
                    </strong>

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


    {{-- =====================================================
         NOTIFIKASI ERROR
    ====================================================== --}}

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

                    <strong>
                        Gagal!
                    </strong>

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


    {{-- =====================================================
         VALIDATION ERROR
    ====================================================== --}}

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


    {{-- =====================================================
         SEARCH
    ====================================================== --}}

    <div class="card border-0 shadow-sm search-card mb-3">

        <div class="card-body p-3">

            <form
                action="{{ route('barangs.index') }}"
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
                                href="{{ route('barangs.index') }}"
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


    {{-- =====================================================
         TABLE CARD
    ====================================================== --}}

    <div class="card border-0 shadow-sm table-card">


        {{-- =================================================
             TABLE HEADER
        ================================================== --}}

        <div class="card-header bg-white border-0 px-3 px-md-4 py-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1 table-title">
                        Daftar Barang
                    </h5>

                    <small class="text-muted table-description">
                        Data master barang yang tersedia di gudang.
                    </small>

                </div>


                {{-- TOTAL BARANG --}}

                @if($barangs->total() > 0)

                    <div class="data-count mt-2 mt-md-0">

                        <span class="count-number">
                            {{ $barangs->total() }}
                        </span>

                        <span class="count-label">
                            Barang
                        </span>

                    </div>

                @endif

            </div>

        </div>


        {{-- =================================================
             FORM BULK DELETE
        ================================================== --}}

        <form
            action="{{ route('barangs.bulkDelete') }}"
            method="POST"
            id="bulkDeleteForm"
        >

            @csrf

            @method('DELETE')


            {{-- =================================================
                 BULK ACTION BAR
            ================================================== --}}

            <div
                class="bulk-action-bar px-3 px-md-4 py-3"
                id="bulkActionBar"
            >

                <div class="d-flex align-items-center gap-3">

                    {{-- PILIH SEMUA --}}

                    <div class="form-check m-0">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="checkAll"
                        >

                        <label
                            class="form-check-label fw-semibold"
                            for="checkAll"
                        >
                            Pilih Semua
                        </label>

                    </div>


                    {{-- JUMLAH TERPILIH --}}

                    <span
                        class="selected-count"
                        id="selectedCount"
                    >
                        0 barang dipilih
                    </span>

                </div>


                {{-- BUTTON HAPUS TERPILIH --}}

                <button
                    type="submit"
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


            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table
                        class="table align-middle mb-0 modern-table"
                    >

                        <thead>

                            <tr>

                                {{-- CHECKBOX --}}

                                <th
                                    class="text-center check-column"
                                >

                                    <span class="visually-hidden">
                                        Pilih
                                    </span>

                                </th>


                                {{-- NO --}}

                                <th
                                    class="text-center no-column"
                                >
                                    No
                                </th>


                                {{-- NAMA --}}

                                <th class="barang-column">
                                    Nama Barang
                                </th>


                                {{-- KOLI --}}

                                <th
                                    class="text-center koli-column"
                                >
                                    Koli
                                </th>


                                {{-- PCS --}}

                                <th
                                    class="text-center pcs-column"
                                >
                                    PCS
                                </th>


                                {{-- SATUAN --}}

                                <th class="satuan-column">
                                    Satuan
                                </th>


                                {{-- AKSI --}}

                                <th
                                    class="text-center aksi-column"
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($barangs as $barang)

                                <tr>

                                    {{-- =================================================
                                         CHECKBOX BARANG
                                    ================================================== --}}

                                    <td class="text-center">

                                        <div
                                            class="form-check d-flex justify-content-center m-0"
                                        >

                                            <input
                                                class="form-check-input barang-checkbox"
                                                type="checkbox"
                                                name="ids[]"
                                                value="{{ $barang->id }}"
                                                id="barang-{{ $barang->id }}"
                                            >

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         NO
                                    ================================================== --}}

                                    <td class="text-center">

                                        <span class="row-number">

                                            {{ $barangs->firstItem() + $loop->index }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                         NAMA BARANG
                                    ================================================== --}}

                                    <td>

                                        <div class="product-name">

                                            {{ $barang->nama_barang }}

                                        </div>

                                        <small class="product-label">

                                            Data Master Barang

                                        </small>

                                    </td>


                                    {{-- =================================================
                                         KOLI
                                    ================================================== --}}

                                    <td class="text-center">

                                        <div class="quantity-box">

                                            <strong>

                                                {{ number_format($barang->jumlah_koli ?? 1) }}

                                            </strong>

                                            <small>
                                                Koli
                                            </small>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         PCS
                                    ================================================== --}}

                                    <td class="text-center">

                                        <div class="quantity-box pcs-box">

                                            <strong>

                                                {{ number_format($barang->pcs_per_koli ?? 0) }}

                                            </strong>

                                            <small>
                                                PCS
                                            </small>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         SATUAN
                                    ================================================== --}}

                                    <td>

                                        @if($barang->satuan)

                                            <span class="unit-badge">

                                                {{ strtoupper($barang->satuan) }}

                                            </span>

                                        @else

                                            <span class="text-muted no-data">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- =================================================
                                         AKSI
                                    ================================================== --}}

                                    <td>

                                        <div class="action-buttons">

                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route('barangs.edit', $barang) }}"
                                                class="action-btn edit-btn"
                                                title="Edit barang"
                                            >
                                                ✏️
                                            </a>


                                            {{-- DELETE SATU BARANG --}}

                                            <button
                                                type="button"
                                                class="action-btn delete-btn"
                                                title="Hapus barang"
                                                onclick="deleteSingleBarang({{ $barang->id }})"
                                            >
                                                🗑️
                                            </button>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- =================================================
                                     EMPTY
                                ================================================== --}}

                                <tr>

                                    <td
                                        colspan="7"
                                        class="empty-state"
                                    >

                                        <div class="empty-icon">
                                            📦
                                        </div>

                                        <h6 class="fw-bold mb-1">
                                            Belum Ada Master Barang
                                        </h6>

                                        <p class="text-muted mb-3">
                                            Belum ada data barang yang tersedia
                                            di dalam master barang.
                                        </p>

                                        <a
                                            href="{{ route('barangs.create') }}"
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


        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if($barangs->hasPages())

            <div class="card-footer bg-white border-0 px-3 px-md-4 py-3">

                <div class="pagination-wrapper">

                    {{-- INFO --}}

                    <div class="pagination-info">

                        Menampilkan

                        <strong>
                            {{ $barangs->firstItem() }}
                        </strong>

                        sampai

                        <strong>
                            {{ $barangs->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $barangs->total() }}
                        </strong>

                        barang

                    </div>


                    {{-- PAGINATION --}}

                    <nav
                        class="pagination-nav"
                        aria-label="Navigasi halaman"
                    >

                        <ul class="pagination custom-pagination mb-0">

                            {{-- PREVIOUS --}}

                            @if($barangs->onFirstPage())

                                <li class="page-item disabled">

                                    <span class="page-link pagination-arrow">
                                        ‹
                                    </span>

                                </li>

                            @else

                                <li class="page-item">

                                    <a
                                        class="page-link pagination-arrow"
                                        href="{{ $barangs->previousPageUrl() }}"
                                        rel="prev"
                                        aria-label="Halaman sebelumnya"
                                    >
                                        ‹
                                    </a>

                                </li>

                            @endif


                            @php

                                $current = $barangs->currentPage();
                                $last = $barangs->lastPage();

                                $range = 2;

                                $start = max(
                                    1,
                                    $current - $range
                                );

                                $end = min(
                                    $last,
                                    $current + $range
                                );

                            @endphp


                            {{-- HALAMAN 1 --}}

                            @if($start > 1)

                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $barangs->url(1) }}"
                                    >
                                        1
                                    </a>

                                </li>


                                @if($start > 2)

                                    <li class="page-item disabled">

                                        <span class="page-link pagination-dots">
                                            ...
                                        </span>

                                    </li>

                                @endif

                            @endif


                            {{-- NOMOR HALAMAN --}}

                            @for(
                                $page = $start;
                                $page <= $end;
                                $page++
                            )

                                @if($page == $current)

                                    <li
                                        class="page-item active"
                                        aria-current="page"
                                    >

                                        <span class="page-link current-page">
                                            {{ $page }}
                                        </span>

                                    </li>

                                @else

                                    <li class="page-item">

                                        <a
                                            class="page-link"
                                            href="{{ $barangs->url($page) }}"
                                        >
                                            {{ $page }}
                                        </a>

                                    </li>

                                @endif

                            @endfor


                            {{-- HALAMAN TERAKHIR --}}

                            @if($end < $last)

                                @if($end < $last - 1)

                                    <li class="page-item disabled">

                                        <span class="page-link pagination-dots">
                                            ...
                                        </span>

                                    </li>

                                @endif


                                <li class="page-item">

                                    <a
                                        class="page-link"
                                        href="{{ $barangs->url($last) }}"
                                    >
                                        {{ $last }}
                                    </a>

                                </li>

                            @endif


                            {{-- NEXT --}}

                            @if($barangs->hasMorePages())

                                <li class="page-item">

                                    <a
                                        class="page-link pagination-arrow"
                                        href="{{ $barangs->nextPageUrl() }}"
                                        rel="next"
                                        aria-label="Halaman berikutnya"
                                    >
                                        ›
                                    </a>

                                </li>

                            @else

                                <li class="page-item disabled">

                                    <span class="page-link pagination-arrow">
                                        ›
                                    </span>

                                </li>

                            @endif

                        </ul>

                    </nav>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- =========================================================
     FORM DELETE SATU BARANG
========================================================= --}}

<form
    id="singleDeleteForm"
    method="POST"
    style="display: none;"
>
    @csrf
    @method('DELETE')
</form>


{{-- =========================================================
     STYLE
========================================================= --}}

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

    padding: 10px 17px;

    font-size: 14px;

    font-weight: 600;

    transition: all 0.2s ease;

}


.btn-header:hover {

    transform: translateY(-1px);

}


.btn-add {

    padding: 10px 19px;

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
   BULK ACTION BAR
========================================================= */

.bulk-action-bar {

    display: flex;

    justify-content: space-between;

    align-items: center;

    min-height: 62px;

    background: #f8fafc;

    border-top: 1px solid #f1f3f5;

    border-bottom: 1px solid #e9ecef;

}


.bulk-action-bar .form-check-label {

    font-size: 14px;

    color: #334155;

    cursor: pointer;

}


.selected-count {

    display: none;

    padding: 5px 11px;

    background: #ffffff;

    border: 1px solid #e2e8f0;

    border-radius: 20px;

    color: #dc3545;

    font-size: 13px;

    font-weight: 600;

}


.selected-count.show {

    display: inline-block;

}


.bulk-delete-btn {

    min-width: 145px;

    font-size: 13px;

    font-weight: 600;

    border-radius: 8px;

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

.check-column {

    width: 55px;

    min-width: 55px;

}


.barang-checkbox,
#checkAll {

    width: 18px;

    height: 18px;

    cursor: pointer;

    border-color: #cbd5e1;

}


.barang-checkbox:checked,
#checkAll:checked {

    background-color: #0d6efd;

    border-color: #0d6efd;

}


.barang-checkbox:focus,
#checkAll:focus {

    box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.12);

}


/* =========================================================
   SELECTED ROW
========================================================= */

.modern-table tbody tr.selected-row {

    background: #eef6ff;

}


.modern-table tbody tr.selected-row:hover {

    background: #e5f1ff;

}


/* =========================================================
   TABLE
========================================================= */

.modern-table {

    width: 100%;

    font-size: 15px;

    table-layout: fixed;

}


/* =========================================================
   COLUMN WIDTH
========================================================= */

.check-column {

    width: 55px;

    min-width: 55px;

}


.no-column {

    width: 8%;

    min-width: 70px;

}


.barang-column {

    width: 30%;

    min-width: 220px;

}


.koli-column {

    width: 13%;

    min-width: 110px;

}


.pcs-column {

    width: 13%;

    min-width: 110px;

}


.satuan-column {

    width: 14%;

    min-width: 120px;

}


.aksi-column {

    width: 14%;

    min-width: 120px;

}


/* =========================================================
   TABLE HEADER
========================================================= */

.modern-table thead {

    background: #f8fafc;

}


.modern-table thead th {

    color: #475569;

    font-size: 13px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 0.3px;

    padding: 16px 14px;

    border-bottom: 1px solid #e9ecef;

    white-space: nowrap;

    vertical-align: middle;

}


/* =========================================================
   TABLE BODY
========================================================= */

.modern-table tbody td {

    padding: 17px 14px;

    border-bottom: 1px solid #f1f3f5;

    vertical-align: middle;

    font-size: 15px;

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
   NOMOR
========================================================= */

.row-number {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    width: 34px;

    height: 34px;

    background: #f1f5f9;

    border-radius: 8px;

    font-size: 13px;

    font-weight: 600;

    color: #64748b;

}


/* =========================================================
   PRODUCT
========================================================= */

.product-name {

    font-size: 16px;

    font-weight: 700;

    color: #1e293b;

    line-height: 1.4;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}


.product-label {

    display: block;

    margin-top: 3px;

    color: #94a3b8;

    font-size: 12px;

}


/* =========================================================
   QUANTITY
========================================================= */

.quantity-box {

    display: inline-flex;

    align-items: baseline;

    justify-content: center;

    gap: 5px;

    padding: 7px 12px;

    background: #f8fafc;

    border-radius: 8px;

    white-space: nowrap;

}


.quantity-box strong {

    font-size: 16px;

    color: #334155;

}


.quantity-box small {

    font-size: 11px;

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
   SATUAN
========================================================= */

.unit-badge {

    display: inline-block;

    padding: 7px 12px;

    background: #f1f5f9;

    color: #475569;

    border-radius: 7px;

    font-size: 13px;

    font-weight: 600;

}


.no-data {

    font-size: 15px;

}


/* =========================================================
   ACTION
========================================================= */

.action-buttons {

    display: flex;

    justify-content: center;

    align-items: center;

    gap: 7px;

}


.action-btn {

    width: 36px;

    height: 36px;

    display: inline-flex;

    align-items: center;

    justify-content: center;

    border: 0;

    border-radius: 8px;

    text-decoration: none;

    transition: all 0.15s ease;

    font-size: 15px;

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

    cursor: pointer;

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

    padding: 70px 20px !important;

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

.pagination-wrapper {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    min-height: 42px;

}


.pagination-info {

    font-size: 13px;

    color: #64748b;

    white-space: nowrap;

}


.pagination-info strong {

    color: #334155;

    font-weight: 700;

}


.pagination-nav {

    display: flex;

    align-items: center;

}


.custom-pagination {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 5px;

    margin: 0;

    padding: 0;

}


.custom-pagination .page-item {

    margin: 0;

    flex: 0 0 auto;

}


.custom-pagination .page-link {

    width: 36px;

    height: 36px;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 0;

    border: 1px solid #e2e8f0;

    border-radius: 8px !important;

    background: #ffffff;

    color: #475569;

    font-size: 13px;

    font-weight: 600;

    text-decoration: none;

    box-shadow: none;

    transition:
        background-color 0.15s ease,
        border-color 0.15s ease,
        color 0.15s ease,
        transform 0.15s ease;

}


.custom-pagination .page-link:hover {

    background: #f1f5f9;

    border-color: #cbd5e1;

    color: #0d6efd;

    transform: translateY(-1px);

}


.custom-pagination .page-item.active .page-link {

    background: #0d6efd;

    border-color: #0d6efd;

    color: #ffffff;

    box-shadow:
        0 2px 7px rgba(13, 110, 253, 0.20);

}


.custom-pagination .page-item.disabled .page-link {

    background: #f8fafc;

    border-color: #e2e8f0;

    color: #cbd5e1;

    cursor: default;

}


.custom-pagination .pagination-arrow {

    font-size: 21px;

    font-weight: 400;

    line-height: 1;

}


.custom-pagination .pagination-dots {

    border-color: transparent;

    background: transparent;

    color: #94a3b8;

    cursor: default;

}


.custom-pagination .pagination-dots:hover {

    transform: none;

    background: transparent;

    border-color: transparent;

    color: #94a3b8;

}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 992px) {

    .modern-table {

        min-width: 900px;

        table-layout: auto;

    }

}


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


    .bulk-action-bar {

        flex-wrap: wrap;

        gap: 12px;

    }


    .bulk-action-bar > div:first-child {

        width: 100%;

    }


    .bulk-delete-btn {

        width: 100%;

    }


    .selected-count {

        font-size: 12px;

    }


    .modern-table {

        min-width: 900px;

        font-size: 14px;

    }


    .modern-table thead th {

        font-size: 12px;

        padding: 13px 10px;

    }


    .modern-table tbody td {

        font-size: 14px;

        padding: 14px 10px;

    }


    .product-name {

        font-size: 15px;

    }


    .product-label {

        font-size: 11px;

    }


    .quantity-box strong {

        font-size: 15px;

    }


    .quantity-box small {

        font-size: 10px;

    }


    .unit-badge {

        font-size: 12px;

        padding: 6px 10px;

    }


    .action-btn {

        width: 34px;

        height: 34px;

    }


    .pagination-wrapper {

        flex-direction: column;

        align-items: center;

        gap: 12px;

    }


    .pagination-info {

        font-size: 12px;

    }


    .custom-pagination {

        gap: 4px;

    }


    .custom-pagination .page-link {

        width: 34px;

        height: 34px;

        font-size: 12px;

    }


    .custom-pagination .pagination-arrow {

        font-size: 19px;

    }

}

</style>


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const checkAll =
        document.getElementById('checkAll');

    const checkboxes =
        document.querySelectorAll('.barang-checkbox');

    const selectedCount =
        document.getElementById('selectedCount');

    const deleteButton =
        document.getElementById('bulkDeleteButton');

    const bulkForm =
        document.getElementById('bulkDeleteForm');


    /*
    |--------------------------------------------------------------------------
    | UPDATE SELECTION
    |--------------------------------------------------------------------------
    */

    function updateSelection() {

        const checked =
            document.querySelectorAll(
                '.barang-checkbox:checked'
            );

        const total =
            checkboxes.length;

        const jumlah =
            checked.length;


        /*
        |----------------------------------------------------------------------
        | JUMLAH TERPILIH
        |----------------------------------------------------------------------
        */

        selectedCount.textContent =
            jumlah + ' barang dipilih';


        /*
        |----------------------------------------------------------------------
        | TAMPILKAN / SEMBUNYIKAN COUNTER
        |----------------------------------------------------------------------
        */

        if (jumlah > 0) {

            selectedCount.classList.add('show');

        } else {

            selectedCount.classList.remove('show');

        }


        /*
        |----------------------------------------------------------------------
        | TOMBOL HAPUS
        |----------------------------------------------------------------------
        */

        deleteButton.disabled =
        
            jumlah === 0;


        /*
        |----------------------------------------------------------------------
        | CHECKBOX PILIH SEMUA
        |----------------------------------------------------------------------
        */

        if (total === 0) {

            checkAll.checked = false;

            checkAll.indeterminate = false;

        }

        else if (jumlah === total) {

            checkAll.checked = true;

            checkAll.indeterminate = false;

        }

        else if (jumlah > 0) {

            checkAll.checked = false;

            checkAll.indeterminate = true;

        }

        else {

            checkAll.checked = false;

            checkAll.indeterminate = false;

        }


        /*
        |----------------------------------------------------------------------
        | HIGHLIGHT BARIS TERPILIH
        |----------------------------------------------------------------------
        */

        checkboxes.forEach(function (checkbox) {

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

    }


    /*
    |--------------------------------------------------------------------------
    | PILIH SEMUA
    |--------------------------------------------------------------------------
    */

    if (checkAll) {

        checkAll.addEventListener(
            'change',
            function () {

                checkboxes.forEach(
                    function (checkbox) {

                        checkbox.checked =
                            checkAll.checked;

                    }
                );


                updateSelection();

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CHECKBOX INDIVIDUAL
    |--------------------------------------------------------------------------
    */

    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            function () {

                updateSelection();

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI BULK DELETE
    |--------------------------------------------------------------------------
    */

    if (bulkForm) {

        bulkForm.addEventListener(
            'submit',
            function (event) {

                const checked =
                    document.querySelectorAll(
                        '.barang-checkbox:checked'
                    );

                const jumlah =
                    checked.length;


                /*
                |--------------------------------------------------------------
                | BELUM MEMILIH
                |--------------------------------------------------------------
                */

                if (jumlah === 0) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih minimal satu barang.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------
                | KONFIRMASI
                |--------------------------------------------------------------
                */

                const yakin =
                    confirm(
                        'Apakah kamu yakin ingin menghapus ' +
                        jumlah +
                        ' barang yang dipilih?'
                    );


                if (!yakin) {

                    event.preventDefault();

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    */

    updateSelection();

});


/*
|--------------------------------------------------------------------------
| HAPUS SATU BARANG
|--------------------------------------------------------------------------
*/

function deleteSingleBarang(id) {

    const yakin =
        confirm(
            'Apakah kamu yakin ingin menghapus barang ini?'
        );


    if (!yakin) {

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    const form =
        document.getElementById(
            'singleDeleteForm'
        );


    /*
    |--------------------------------------------------------------------------
    | ACTION
    |--------------------------------------------------------------------------
    */

    form.action =
        '/barangs/' + id;


    /*
    |--------------------------------------------------------------------------
    | SUBMIT
    |--------------------------------------------------------------------------
    */

    form.submit();

}

</script>

@endsection