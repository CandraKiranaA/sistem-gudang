@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')

<div class="container-fluid master-page px-3 px-md-4 py-3">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="page-header mb-4">

        <div class="page-heading">

            <div class="page-icon">
                📦
            </div>

            <div>
                <h3 class="page-title">
                    Master Barang
                </h3>

                <p class="page-subtitle">
                    Kelola data barang yang tersedia di gudang.
                </p>
            </div>

        </div>


        {{-- BUTTON HEADER --}}

        <div class="header-actions">

            <a
                href="{{ route('barangs.import.form') }}"
                class="btn-header btn-import"
            >
                <span>📥</span>
                Import
            </a>

            <a
                href="{{ route('barangs.export') }}"
                class="btn-header btn-export"
            >
                <span>📤</span>
                Export
            </a>

            <a
                href="{{ route('barangs.create') }}"
                class="btn-header btn-add"
            >
                <span>＋</span>
                Tambah Barang
            </a>

        </div>

    </div>


    {{-- =====================================================
         NOTIFIKASI SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div
            class="alert custom-alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <div class="alert-content">

                <div class="alert-icon success-icon">
                    ✓
                </div>

                <div>
                    <strong>Berhasil!</strong>
                    <div>{{ session('success') }}</div>
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
            class="alert custom-alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <div class="alert-content">

                <div class="alert-icon danger-icon">
                    !
                </div>

                <div>
                    <strong>Gagal!</strong>
                    <div>{{ session('error') }}</div>
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

        <div class="alert custom-alert alert-danger">

            <div class="alert-content align-items-start">

                <div class="alert-icon danger-icon">
                    !
                </div>

                <div>

                    <strong>Terjadi kesalahan</strong>

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

    <div class="search-area mb-3">

        <form
            action="{{ route('barangs.index') }}"
            method="GET"
        >

            <div class="search-row">

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

                <button
                    type="submit"
                    class="search-button"
                >
                    Cari
                </button>

                @if(request('search'))

                    <a
                        href="{{ route('barangs.index') }}"
                        class="reset-button"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

    </div>


    {{-- =====================================================
         TABLE AREA
    ====================================================== --}}

    <div class="table-section">

        {{-- TABLE HEADER --}}

        <div class="table-heading">

            <div>

                <h5>
                    Daftar Barang
                </h5>

                <span>
                    Data master barang yang tersedia di gudang.
                </span>

            </div>

            @if($barangs->total() > 0)

                <div class="data-count">

                    <strong>
                        {{ $barangs->total() }}
                    </strong>

                    <span>
                        Barang
                    </span>

                </div>

            @endif

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


            {{-- BULK ACTION --}}

            <div
                class="bulk-action-bar"
                id="bulkActionBar"
            >

                <div class="bulk-left">

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="checkAll"
                        >

                        <label
                            class="form-check-label"
                            for="checkAll"
                        >
                            Pilih Semua
                        </label>

                    </div>

                    <span
                        class="selected-count"
                        id="selectedCount"
                    >
                        0 barang dipilih
                    </span>

                </div>


                <button
                    type="submit"
                    id="bulkDeleteButton"
                    class="bulk-delete-btn"
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

            <div class="table-responsive">

                <table class="table modern-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="check-column text-center">
                                <span class="visually-hidden">
                                    Pilih
                                </span>
                            </th>

                            <th class="no-column text-center">
                                No
                            </th>

                            <th class="barang-column">
                                Nama Barang
                            </th>

                            <th class="koli-column text-center">
                                Koli
                            </th>

                            <th class="pcs-column text-center">
                                PCS
                            </th>

                            <th class="satuan-column">
                                Satuan
                            </th>

                            <th class="aksi-column text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($barangs as $barang)

                            <tr>

                                {{-- CHECKBOX --}}

                                <td class="text-center">

                                    <div class="form-check checkbox-center">

                                        <input
                                            class="form-check-input barang-checkbox"
                                            type="checkbox"
                                            name="ids[]"
                                            value="{{ $barang->id }}"
                                            id="barang-{{ $barang->id }}"
                                        >

                                    </div>

                                </td>


                                {{-- NO --}}

                                <td class="text-center">

                                    <span class="row-number">
                                        {{ $barangs->firstItem() + $loop->index }}
                                    </span>

                                </td>


                                {{-- NAMA BARANG --}}

                                <td>

                                    <div class="product-name">
                                        {{ $barang->nama_barang }}
                                    </div>

                                    <small class="product-label">
                                        Data Master Barang
                                    </small>

                                </td>


                                {{-- KOLI --}}

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


                                {{-- PCS --}}

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


                                {{-- SATUAN --}}

                                <td>

                                    @if($barang->satuan)

                                        <span class="unit-badge">
                                            {{ strtoupper($barang->satuan) }}
                                        </span>

                                    @else

                                        <span class="no-data">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="action-buttons">

                                        <a
                                            href="{{ route('barangs.edit', $barang) }}"
                                            class="action-btn edit-btn"
                                            title="Edit barang"
                                        >
                                            ✏️
                                        </a>

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

                            <tr>

                                <td
                                    colspan="7"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">
                                        📦
                                    </div>

                                    <h6>
                                        Belum Ada Master Barang
                                    </h6>

                                    <p>
                                        Belum ada data barang yang tersedia
                                        di dalam master barang.
                                    </p>

                                    <a
                                        href="{{ route('barangs.create') }}"
                                        class="empty-button"
                                    >
                                        ＋ Tambah Barang
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </form>


        {{-- =================================================
             PAGINATION
        ================================================== --}}

        @if($barangs->hasPages())

            <div class="pagination-area">

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


                <nav aria-label="Navigasi halaman">

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

                                    <span class="page-link">
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

        @endif

    </div>

</div>


{{-- =========================================================
     FORM DELETE SATU BARANG
========================================================= --}}

<form
    id="singleDeleteForm"
    method="POST"
    style="display:none;"
>
    @csrf
    @method('DELETE')
</form>


<style>

/* =========================================================
   PAGE
========================================================= */

.master-page {
    max-width: 100%;
    color: #334155;
}


/* =========================================================
   HEADER
========================================================= */

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.page-heading {
    display: flex;
    align-items: center;
    gap: 13px;
}

.page-icon {
    width: 43px;
    height: 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #fffbea;
    border: 1px solid #f1e5aa;

    border-radius: 10px;

    font-size: 20px;

    box-shadow:
        0 2px 7px rgba(180, 145, 0, 0.06);
}

.page-title {
    margin: 0;

    color: #1e293b;

    font-size: 22px;
    font-weight: 700;
}

.page-subtitle {
    margin: 3px 0 0;

    color: #94a3b8;

    font-size: 13px;
}


/* =========================================================
   HEADER BUTTONS
========================================================= */

.header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-header {
    min-height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 5px;

    padding: 0 15px;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition: all .18s ease;
}

.btn-header:hover {
    transform: translateY(-1px);
}

.btn-import {
    color: #475569;

    background: #ffffff;

    border: 1px solid #dfe4ea;
}

.btn-import:hover {
    color: #8a6d00;

    background: #fffbea;

    border-color: #ead98c;
}

.btn-export {
    color: #475569;

    background: #ffffff;

    border: 1px solid #dfe4ea;
}

.btn-export:hover {
    color: #8a6d00;

    background: #fffbea;

    border-color: #ead98c;
}

.btn-add {
    color: #ffffff;

    background: #c49a00;

    border: 1px solid #c49a00;

    box-shadow:
        0 3px 9px rgba(180, 145, 0, .14);
}

.btn-add:hover {
    color: #ffffff;

    background: #ad8700;

    border-color: #ad8700;
}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {
    display: flex;
    align-items: center;
    justify-content: space-between;

    border: 1px solid transparent;

    border-radius: 9px;

    margin-bottom: 14px;

    padding: 12px 14px;

    font-size: 13px;
}

.alert-content {
    display: flex;
    align-items: center;
}

.custom-alert strong {
    font-size: 13px;
}

.alert-icon {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 10px;

    border-radius: 50%;

    font-weight: 700;
}

.success-icon {
    color: #24704a;
    background: #e4f4ea;
}

.danger-icon {
    color: #a33a45;
    background: #fbe7e9;
}


/* =========================================================
   SEARCH
========================================================= */

.search-area {
    background: #ffffff;

    border: 1px solid #e9ecef;

    border-radius: 9px;

    padding: 12px 14px;

    box-shadow:
        0 2px 7px rgba(15, 23, 42, .025);
}

.search-row {
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-wrapper {
    position: relative;

    width: 430px;
    max-width: 100%;
}

.search-icon {
    position: absolute;

    left: 13px;
    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    font-size: 14px;

    opacity: .55;
}

.search-input {
    height: 40px;

    padding-left: 38px;
    padding-right: 12px;

    border: 1px solid #dfe4ea;

    border-radius: 7px;

    color: #334155;

    font-size: 13px;

    box-shadow: none;
}

.search-input::placeholder {
    color: #a1aab5;
}

.search-input:focus {
    border-color: #d9bd4d;

    box-shadow:
        0 0 0 3px rgba(212, 167, 0, .09);
}

.search-button {
    height: 40px;

    padding: 0 19px;

    border: 1px solid #c49a00;

    border-radius: 7px;

    color: #ffffff;

    background: #c49a00;

    font-size: 13px;
    font-weight: 600;

    transition: all .18s ease;
}

.search-button:hover {
    background: #ad8700;
    border-color: #ad8700;
}

.reset-button {
    height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 15px;

    border: 1px solid #dfe4ea;

    border-radius: 7px;

    color: #64748b;

    background: #ffffff;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;
}

.reset-button:hover {
    color: #475569;

    background: #f8fafc;
}


/* =========================================================
   TABLE SECTION
========================================================= */

.table-section {
    background: #ffffff;

    border: 1px solid #e6e8eb;

    border-radius: 10px;

    overflow: hidden;

    box-shadow:
        0 3px 10px rgba(15, 23, 42, .035);
}


/* =========================================================
   TABLE HEADING
========================================================= */

.table-heading {
    min-height: 68px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 13px 17px;

    border-bottom: 1px solid #eceef0;

    background: #ffffff;
}

.table-heading h5 {
    margin: 0 0 3px;

    color: #1e293b;

    font-size: 16px;
    font-weight: 700;
}

.table-heading span {
    color: #94a3b8;

    font-size: 12px;
}

.data-count {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 6px 11px;

    border: 1px solid #eee5bd;

    border-radius: 20px;

    background: #fffdf3;
}

.data-count strong {
    color: #9a7800;

    font-size: 13px;
}

.data-count span {
    color: #9a8d5c;

    font-size: 12px;
}


/* =========================================================
   BULK ACTION
========================================================= */

.bulk-action-bar {
    min-height: 52px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 8px 17px;

    background: #fafafa;

    border-bottom: 1px solid #eceef0;
}

.bulk-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.bulk-action-bar .form-check {
    display: flex;
    align-items: center;

    margin: 0;
}

.bulk-action-bar .form-check-label {
    margin-left: 5px;

    color: #475569;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;
}

.selected-count {
    display: none;

    padding: 4px 9px;

    color: #9b7500;

    background: #fffbea;

    border: 1px solid #eee0a5;

    border-radius: 15px;

    font-size: 11px;
    font-weight: 600;
}

.selected-count.show {
    display: inline-block;
}

.bulk-delete-btn {
    height: 34px;

    padding: 0 13px;

    border: 1px solid #ead1d4;

    border-radius: 7px;

    color: #a33a45;

    background: #fff7f7;

    font-size: 12px;
    font-weight: 600;

    transition: all .18s ease;
}

.bulk-delete-btn:not(:disabled):hover {
    color: #ffffff;

    background: #c94b57;

    border-color: #c94b57;
}

.bulk-delete-btn:disabled {
    opacity: .4;

    cursor: not-allowed;
}


/* =========================================================
   CHECKBOX
========================================================= */

.checkbox-center {
    display: flex;

    align-items: center;
    justify-content: center;

    margin: 0;
}

.barang-checkbox,
#checkAll {
    width: 17px;
    height: 17px;

    border-color: #cbd5df;

    cursor: pointer;
}

.barang-checkbox:checked,
#checkAll:checked {
    background-color: #c49a00;
    border-color: #c49a00;
}

.barang-checkbox:focus,
#checkAll:focus {
    box-shadow:
        0 0 0 3px rgba(196, 154, 0, .10);
}


/* =========================================================
   TABLE
========================================================= */

.modern-table {
    width: 100%;

    table-layout: fixed;

    font-size: 13px;
}

.modern-table thead {
    background: #fafafa;
}

.modern-table thead th {
    padding: 13px 12px;

    color: #64748b;

    border-bottom: 1px solid #e5e7eb;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .35px;

    white-space: nowrap;
}

.modern-table tbody td {
    padding: 14px 12px;

    color: #475569;

    border-bottom: 1px solid #f0f1f2;

    vertical-align: middle;
}

.modern-table tbody tr {
    transition: background-color .15s ease;
}

.modern-table tbody tr:hover {
    background: #fffdf5;
}

.modern-table tbody tr:last-child td {
    border-bottom: 0;
}

.modern-table tbody tr.selected-row {
    background: #fffbea;
}

.modern-table tbody tr.selected-row:hover {
    background: #fff8df;
}


/* =========================================================
   COLUMN
========================================================= */

.check-column {
    width: 50px;
}

.no-column {
    width: 70px;
}

.barang-column {
    width: 34%;
}

.koli-column {
    width: 12%;
}

.pcs-column {
    width: 12%;
}

.satuan-column {
    width: 13%;
}

.aksi-column {
    width: 13%;
}


/* =========================================================
   NUMBER
========================================================= */

.row-number {
    width: 28px;
    height: 28px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    color: #64748b;

    background: #f5f6f7;

    font-size: 12px;
    font-weight: 600;
}


/* =========================================================
   PRODUCT
========================================================= */

.product-name {
    max-width: 100%;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    color: #263244;

    font-size: 14px;
    font-weight: 650;
}

.product-label {
    display: block;

    margin-top: 2px;

    color: #a1a9b3;

    font-size: 10px;
}


/* =========================================================
   QUANTITY
========================================================= */

.quantity-box {
    display: inline-flex;
    align-items: baseline;
    justify-content: center;

    gap: 4px;

    min-width: 65px;

    padding: 5px 9px;

    background: #f7f8f9;

    border-radius: 6px;
}

.quantity-box strong {
    color: #475569;

    font-size: 13px;
}

.quantity-box small {
    color: #a0a8b1;

    font-size: 9px;
    font-weight: 700;
}

.pcs-box {
    background: #fffbea;
}

.pcs-box strong {
    color: #9a7800;
}

.pcs-box small {
    color: #b39b46;
}


/* =========================================================
   SATUAN
========================================================= */

.unit-badge {
    display: inline-block;

    padding: 5px 9px;

    color: #75611c;

    background: #fffbea;

    border: 1px solid #eee4b8;

    border-radius: 6px;

    font-size: 11px;
    font-weight: 600;
}

.no-data {
    color: #aeb5bd;

    font-size: 13px;
}


/* =========================================================
   ACTION
========================================================= */

.action-buttons {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 6px;
}

.action-btn {
    width: 32px;
    height: 32px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 1px solid transparent;

    border-radius: 7px;

    text-decoration: none;

    font-size: 13px;

    transition: all .16s ease;
}

.edit-btn {
    background: #fff8df;

    border-color: #f0e3a9;
}

.edit-btn:hover {
    background: #f4d86a;

    border-color: #e1c34b;

    transform: translateY(-1px);
}

.delete-btn {
    background: #fff5f5;

    border-color: #efd9dc;

    cursor: pointer;
}

.delete-btn:hover {
    color: #ffffff;

    background: #c94b57;

    border-color: #c94b57;

    transform: translateY(-1px);
}


/* =========================================================
   EMPTY
========================================================= */

.empty-state {
    padding: 65px 20px !important;

    text-align: center;
}

.empty-icon {
    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 12px;

    background: #fffbea;

    border: 1px solid #eee3b4;

    border-radius: 50%;

    font-size: 26px;
}

.empty-state h6 {
    margin-bottom: 4px;

    color: #334155;

    font-size: 15px;
}

.empty-state p {
    margin-bottom: 15px;

    color: #94a3b8;

    font-size: 12px;
}

.empty-button {
    display: inline-flex;
    align-items: center;

    padding: 8px 13px;

    color: #ffffff;

    background: #c49a00;

    border-radius: 7px;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;
}

.empty-button:hover {
    color: #ffffff;

    background: #ad8700;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-area {
    min-height: 62px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 10px 17px;

    border-top: 1px solid #eceef0;

    background: #ffffff;
}

.pagination-info {
    color: #94a3b8;

    font-size: 11px;
}

.pagination-info strong {
    color: #475569;

    font-weight: 700;
}

.custom-pagination {
    display: flex;

    align-items: center;

    gap: 4px;
}

.custom-pagination .page-item {
    margin: 0;
}

.custom-pagination .page-link {
    width: 31px;
    height: 31px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    color: #64748b;

    background: #ffffff;

    border: 1px solid #e2e5e8;

    border-radius: 6px !important;

    font-size: 11px;
    font-weight: 600;

    box-shadow: none;

    transition: all .15s ease;
}

.custom-pagination .page-link:hover {
    color: #8a6d00;

    background: #fffbea;

    border-color: #e8d98e;
}

.custom-pagination .page-item.active .page-link {
    color: #ffffff;

    background: #c49a00;

    border-color: #c49a00;

    box-shadow:
        0 2px 6px rgba(196, 154, 0, .16);
}

.custom-pagination .page-item.disabled .page-link {
    color: #cbd0d5;

    background: #fafafa;

    border-color: #eeeeee;
}

.custom-pagination .pagination-arrow {
    font-size: 17px;
    font-weight: 400;
}

.custom-pagination .pagination-dots {
    color: #aab1b8;

    background: transparent;

    border-color: transparent;
}

.custom-pagination .pagination-dots:hover {
    color: #aab1b8;

    background: transparent;

    border-color: transparent;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 992px) {

    .page-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .header-actions {
        width: 100%;
    }

    .btn-header {
        flex: 1;
    }

    .search-wrapper {
        width: 100%;
    }

    .modern-table {
        min-width: 850px;

        table-layout: auto;
    }

}


@media (max-width: 768px) {

    .master-page {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .page-title {
        font-size: 20px;
    }

    .page-subtitle {
        font-size: 12px;
    }

    .header-actions {
        display: grid;

        grid-template-columns: 1fr 1fr;
    }

    .btn-add {
        grid-column: span 2;
    }

    .search-row {
        flex-wrap: wrap;
    }

    .search-wrapper {
        width: 100%;
    }

    .search-button,
    .reset-button {
        flex: 1;
    }

    .table-heading {
        padding: 12px 14px;
    }

    .table-heading h5 {
        font-size: 15px;
    }

    .bulk-action-bar {
        padding: 8px 14px;
    }

    .pagination-area {
        flex-direction: column;
        justify-content: center;

        padding: 12px;
    }

    .pagination-info {
        text-align: center;
    }

    .custom-pagination {
        gap: 3px;
    }

}


/* =========================================================
   SMALL MOBILE
========================================================= */

@media (max-width: 480px) {

    .page-heading {
        align-items: flex-start;
    }

    .page-icon {
        width: 38px;
        height: 38px;

        font-size: 18px;
    }

    .header-actions {
        gap: 6px;
    }

    .btn-header {
        min-height: 38px;

        padding: 0 9px;

        font-size: 12px;
    }

    .search-area {
        padding: 10px;
    }

    .table-heading {
        min-height: 60px;
    }

    .table-description {
        display: none;
    }

    .data-count {
        padding: 5px 8px;
    }

    .bulk-left {
        gap: 8px;
    }

    .bulk-action-bar .form-check-label {
        font-size: 12px;
    }

    .bulk-delete-btn {
        padding: 0 9px;

        font-size: 11px;
    }

}

</style>


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
        | COUNTER
        |----------------------------------------------------------------------
        */

        selectedCount.textContent =
            jumlah + ' barang dipilih';


        if (jumlah > 0) {

            selectedCount.classList.add('show');

        } else {

            selectedCount.classList.remove('show');

        }


        /*
        |----------------------------------------------------------------------
        | BUTTON DELETE
        |----------------------------------------------------------------------
        */

        deleteButton.disabled =
            jumlah === 0;


        /*
        |----------------------------------------------------------------------
        | CHECK ALL
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
        | SELECTED ROW
        |----------------------------------------------------------------------
        */

        checkboxes.forEach(function (checkbox) {

            const row =
                checkbox.closest('tr');

            if (!row) {

                return;

            }

            if (checkbox.checked) {

                row.classList.add('selected-row');

            } else {

                row.classList.remove('selected-row');

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CHECK ALL
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
    | INDIVIDUAL CHECKBOX
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
    | BULK DELETE
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


                if (jumlah === 0) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih minimal satu barang.'
                    );

                    return;

                }


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
    | INITIAL
    |--------------------------------------------------------------------------
    */

    updateSelection();

});


/*
|--------------------------------------------------------------------------
| DELETE SINGLE
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


    const form =
        document.getElementById(
            'singleDeleteForm'
        );


    form.action =
        '/barangs/' + id;


    form.submit();

}

</script>

@endsection