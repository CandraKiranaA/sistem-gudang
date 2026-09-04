@extends('layouts.app')

@section('content')

<div class="container-fluid px-3 px-md-4 py-4">


{{-- ===================================================== --}}
{{-- HEADER --}}
{{-- ===================================================== --}}

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

    <div>

        <div class="d-flex align-items-center gap-3 mb-1">

            <div class="page-icon">
                📦
            </div>

            <div>
                <h3 class="fw-bold mb-0 page-title">
                    Barang Masuk
                </h3>

                <p class="page-subtitle mb-0">
                    Kelola dan pantau data barang yang masuk ke gudang.
                </p>
            </div>

        </div>

    </div>


    {{-- ================================================= --}}
{{-- BUTTON HEADER --}}
{{-- ================================================= --}}

<div class="header-actions">

    <a
        href="{{ route('barang-masuk.import.form') }}"
        class="btn-header btn-import"
    >
        <span>📥</span>
        Import
    </a>

    <a
        href="{{ route('barang-masuk.export') }}"
        class="btn-header btn-export"
    >
        <span>📤</span>
        Export
    </a>

        <a
            href="{{ route('barang-masuk.create') }}"
            class="btn btn-gold btn-add"
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

<div class="card border-0 search-card mb-3">

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
                        class="btn btn-search px-4"
                    >
                        Cari
                    </button>

                </div>


                @if(request('search'))

                    <div class="col-auto">

                        <a
                            href="{{ route('barang-masuk.index') }}"
                            class="btn btn-reset px-3"
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

<div class="card border-0 table-card">


    {{-- ================================================= --}}
    {{-- TABLE HEADER --}}
    {{-- ================================================= --}}

    <div class="card-header table-card-header px-3 px-md-4 py-3">

        <div class="d-flex flex-wrap justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1 table-title">
                    Daftar Barang Masuk
                </h5>

                <small class="table-description">
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
                    class="btn bulk-delete-btn"
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

                                {{-- CHECKBOX --}}
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


                                {{-- NO --}}
                                <td class="text-center">

                                    <span class="row-number">

                                        {{ $barangMasuks->firstItem() + $loop->index }}

                                    </span>

                                </td>


                                {{-- TANGGAL --}}
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


                                {{-- BARANG --}}
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


                                {{-- EDISI --}}
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


                                {{-- KOLI --}}
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


                                {{-- PCS --}}
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


                                {{-- HARGA BELI --}}
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


                                {{-- HARGA JUAL KOLI --}}
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


                                {{-- HARGA JUAL PCS --}}
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


                                {{-- AKSI --}}
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

                            {{-- EMPTY --}}

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
                                        class="btn btn-gold btn-sm px-3"
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

            <div class="pagination-info">

                Menampilkan

                <strong>{{ $barangMasuks->firstItem() }}</strong>

                sampai

                <strong>{{ $barangMasuks->lastItem() }}</strong>

                dari

                <strong>{{ $barangMasuks->total() }}</strong>

                data

            </div>


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

</div>


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


</div>

{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

<style>

/* =========================================================
   GENERAL
========================================================= */

.page-title {
    color: #1f2937;
    font-size: 25px;
    letter-spacing: -0.3px;
}

.page-subtitle {
    color: #6b7280;
    font-size: 13px;
    margin-top: 4px;
}

.page-icon {
    width: 46px;
    height: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        135deg,
        #fffbea,
        #fffdf7
    );

    border: 1px solid #f0e4ae;
    border-left: 4px solid #d4a700;

    border-radius: 12px;

    font-size: 21px;

    box-shadow:
        0 2px 7px rgba(212, 167, 0, 0.06);
}

.btn {
    border-radius: 10px;
}

/* =========================================================
   HEADER ACTIONS
========================================================= */

.header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.btn-header {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    min-height: 40px;

    padding: 9px 15px;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition: all .2s ease;
}

.btn-header span {
    font-size: 14px;
    line-height: 1;
}


/* =========================================================
   IMPORT
========================================================= */

.btn-import {
    background: #ffffff;

    color: #596273;

    border: 1px solid #dfe3e8;
}

.btn-import:hover {
    color: #374151;

    background: #f9fafb;

    border-color: #cfd5dc;

    transform: translateY(-1px);
}


/* =========================================================
   EXPORT
========================================================= */

.btn-export {
    background: #ffffff;

    color: #596273;

    border: 1px solid #dfe3e8;
}

.btn-export:hover {
    color: #374151;

    background: #f9fafb;

    border-color: #cfd5dc;

    transform: translateY(-1px);
}


/* =========================================================
   TAMBAH BARANG
========================================================= */

.btn-add {
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #c7a21a,
        #a98200
    );

    border: 1px solid #b48f00;

    box-shadow:
        0 4px 12px rgba(169, 130, 0, .16);
}

.btn-add:hover {
    color: #ffffff;

    background: linear-gradient(
        135deg,
        #b89100,
        #977400
    );

    border-color: #977400;

    transform: translateY(-1px);

    box-shadow:
        0 5px 14px rgba(169, 130, 0, .22);
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .header-actions {
        width: 100%;
    }

    .btn-header {
        flex: 1;
    }

}


/* =========================================================
   ALERT
========================================================= */

.custom-alert {
    border: 1px solid transparent;
    border-radius: 11px;

    box-shadow:
        0 2px 8px rgba(0, 0, 0, 0.035);
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
    background: #edf8f1;
    color: #25824e;
}

.danger-icon {
    background: #fff1f2;
    color: #c2414b;
}


/* =========================================================
   SEARCH
========================================================= */

.search-card {
    border-radius: 13px;

    background: #ffffff;

    border: 1px solid #edf0f2 !important;

    box-shadow:
        0 3px 12px rgba(31, 41, 55, 0.045);
}

.search-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;

    left: 14px;
    top: 50%;

    transform: translateY(-50%);

    z-index: 2;

    font-size: 14px;
    opacity: 0.55;
}

.search-input {
    padding-left: 41px;

    height: 44px;

    border-radius: 9px;

    border: 1px solid #e3e7eb;

    background: #fafbfc;

    font-size: 13px;

    color: #374151;

    transition: all 0.2s ease;
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-input:focus {
    background: #ffffff;

    border-color: #d4b32d;

    box-shadow:
        0 0 0 3px rgba(212, 179, 45, 0.10);
}

.btn-search {
    height: 44px;

    color: #ffffff;

    background: #b18b00;

    border: 1px solid #a27e00;

    font-size: 13px;
    font-weight: 600;

    transition: all 0.2s ease;
}

.btn-search:hover {
    color: #ffffff;

    background: #987500;
    border-color: #8d6c00;
}

.btn-reset {
    height: 44px;

    display: flex;
    align-items: center;

    background: #f8f9fa;

    border: 1px solid #e1e5e9;

    color: #64748b;

    font-size: 13px;
}

.btn-reset:hover {
    background: #f1f3f5;
    color: #374151;
}


/* =========================================================
   TABLE CARD
========================================================= */

.table-card {
    border-radius: 14px;

    overflow: hidden;

    background: #ffffff;

    border: 1px solid #edf0f2 !important;

    box-shadow:
        0 4px 16px rgba(31, 41, 55, 0.05);
}

.table-card-header {
    background: linear-gradient(
        135deg,
        #ffffff,
        #fffefa
    );

    border-bottom: 1px solid #f0f1f2 !important;
}

.table-title {
    color: #1f2937;
    font-size: 18px;
    letter-spacing: -0.2px;
}

.table-description {
    color: #8a929d;
    font-size: 12px;
}

.data-count {
    background: #fffbea;

    border: 1px solid #f1e5ae;

    padding: 7px 13px;

    border-radius: 20px;

    font-size: 12px;
}

.count-number {
    font-weight: 700;
    color: #9a7800;
}

.count-label {
    color: #8a929d;
    margin-left: 3px;
}


/* =========================================================
   BULK DELETE
========================================================= */

.bulk-delete-btn {
    padding: 8px 14px;

    font-size: 12px;
    font-weight: 600;

    color: #b4535c;

    background: #fffafa;

    border: 1px solid #f1d9dc;

    white-space: nowrap;

    transition: all 0.2s ease;
}

.bulk-delete-btn:disabled {
    opacity: 0.45;
    cursor: not-allowed;
}

.bulk-delete-btn:not(:disabled):hover {
    color: #ffffff;

    background: #c6535e;

    border-color: #c6535e;

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
    width: 17px;
    height: 17px;

    margin: 0;

    cursor: pointer;

    border-radius: 5px;

    border-color: #d5d9de;
}

.row-checkbox:focus {
    box-shadow:
        0 0 0 3px rgba(212, 167, 0, 0.10);
}

.item-checkbox:checked,
#checkAll:checked {
    background-color: #b18b00;
    border-color: #b18b00;
}


/* =========================================================
   TABLE UTAMA
========================================================= */

.modern-table {
    width: 100%;

    font-size: 14px;

    table-layout: fixed;
}


/* =========================================================
   HEADER TABLE
========================================================= */

.modern-table thead {
    background: #fafafa;
}

.modern-table thead th {
    color: #68717d;

    font-size: 11px;
    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 0.35px;

    padding: 14px 10px;

    border-bottom: 1px solid #e9ecef;

    white-space: nowrap;

    vertical-align: middle;
}


/* =========================================================
   BODY TABLE
========================================================= */

.modern-table tbody td {
    padding: 15px 10px;

    border-bottom: 1px solid #f0f1f3;

    vertical-align: middle;

    font-size: 13px;

    color: #4b5563;
}

.modern-table tbody tr {
    transition:
        background-color 0.15s ease;
}

.modern-table tbody tr:hover {
    background: #fffdf7;
}

.modern-table tbody tr:last-child td {
    border-bottom: 0;
}


/* =========================================================
   SELECTED ROW
========================================================= */

.modern-table tbody tr.selected-row {
    background: #fffbea;
}

.modern-table tbody tr.selected-row td {
    border-bottom-color: #f3e9b9;
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

    width: 30px;
    height: 30px;

    background: #f5f6f8;

    border: 1px solid #eceef0;

    border-radius: 8px;

    font-size: 12px;

    font-weight: 600;

    color: #737b87;
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

    font-size: 13px;

    font-weight: 700;

    color: #374151;

    line-height: 1.3;
}

.date-sub {
    display: block;

    white-space: nowrap !important;

    font-size: 10px;

    color: #a0a7b0;

    margin-top: 3px;
}


/* =========================================================
   BARANG
========================================================= */

.product-name {
    font-size: 14px;

    font-weight: 700;

    color: #29313d;

    line-height: 1.35;

    white-space: normal;

    overflow-wrap: break-word;
}

.product-unit {
    margin-top: 3px;

    color: #8b939e;

    font-size: 10px;

    font-weight: 600;

    letter-spacing: 0.3px;
}

.product-not-found {
    font-size: 13px;
    font-weight: 600;
}


/* =========================================================
   EDISI
========================================================= */

.edition-badge {
    display: inline-block;

    padding: 5px 9px;

    background: #fffbea;

    color: #967600;

    border: 1px solid #f0e4ae;

    border-radius: 7px;

    font-size: 11px;

    font-weight: 600;

    max-width: 100%;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.no-data {
    font-size: 14px;
    color: #a3a9b1;
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

    background: #f7f8f9;

    border: 1px solid #edf0f2;

    border-radius: 8px;

    white-space: nowrap;
}

.quantity-box strong {
    font-size: 13px;
    color: #4b5563;
}

.quantity-box small {
    font-size: 9px;
    color: #9ca3af;
    font-weight: 700;
}

.pcs-box {
    background: #fffbea;
    border-color: #f2e6af;
}

.pcs-box strong {
    color: #9a7800;
}


/* =========================================================
   HARGA
========================================================= */

.price-column {
    white-space: nowrap;
}

.currency-label {
    font-size: 10px;

    color: #9ca3af;

    margin-right: 2px;

    font-weight: 500;
}

.price-text {
    font-size: 12px;

    color: #4b5563;

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
    width: 33px;
    height: 33px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border: 1px solid transparent;

    border-radius: 8px;

    text-decoration: none;

    transition: all 0.15s ease;

    font-size: 13px;
}

.edit-btn {
    background: #fffbea;
    border-color: #f0e4ae;
}

.edit-btn:hover {
    background: #f5df76;
    border-color: #d7b934;

    transform: translateY(-1px);
}

.delete-btn {
    background: #fffafa;
    border-color: #f1d9dc;
}

.delete-btn:hover {
    background: #dc626c;
    border-color: #dc626c;

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

    background: #fffbea;

    border: 1px solid #f0e4ae;

    border-radius: 50%;

    font-size: 30px;
}

.empty-state h6 {
    color: #374151;
    font-size: 15px;
}

.empty-state p {
    font-size: 13px;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-container {
    width: 100%;

    display: flex;

    align-items: center;
    justify-content: space-between;

    padding: 17px 24px;

    border-top: 1px solid #edf0f2;

    background: #ffffff;
}

.pagination-info {
    font-size: 12px;

    color: #8a929d;

    white-space: nowrap;
}

.pagination-info strong {
    color: #4b5563;
    font-weight: 700;
}

.custom-pagination {
    display: flex;

    align-items: center;

    gap: 5px;

    margin: 0;
    padding: 0;
}

.pagination-btn {
    width: 35px;
    height: 35px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 0;
    margin: 0;

    border: 1px solid #e4e7ea;

    border-radius: 8px;

    background: #ffffff;

    color: #69717d;

    text-decoration: none;

    font-size: 12px;

    font-weight: 600;

    line-height: 1;

    box-sizing: border-box;

    transition: all 0.15s ease;
}

.pagination-btn:hover {
    background: #fffbea;

    border-color: #dfca6c;

    color: #9a7800;

    text-decoration: none;
}

.pagination-btn.active {
    background: #b18b00;

    border-color: #b18b00;

    color: #ffffff;

    box-shadow:
        0 2px 6px rgba(177, 139, 0, 0.16);
}

.pagination-btn.disabled {
    background: #f8f9fa;

    color: #c5c9ce;

    border-color: #e8eaed;

    cursor: default;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 768px) {

    .container-fluid {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }

    .page-title {
        font-size: 21px;
    }

    .page-subtitle {
        font-size: 12px;
    }

    .page-icon {
        width: 42px;
        height: 42px;
        font-size: 19px;
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

    .modern-table {
        min-width: 1100px;
        table-layout: fixed;
    }

    .modern-table thead th {
        font-size: 10px;
        padding: 13px 9px;
    }

    .modern-table tbody td {
        font-size: 12px;
        padding: 14px 9px;
    }

    .date-main {
        font-size: 12px;
    }

    .date-sub {
        font-size: 9px;
    }

    .product-name {
        font-size: 13px;
    }

    .quantity-box strong {
        font-size: 12px;
    }

    .price-text {
        font-size: 11px;
    }

    .bulk-delete-btn {
        width: 100%;
    }

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

    .modern-table {
        min-width: 1050px;
    }

    .pagination-btn {
        width: 34px;
        height: 34px;

        font-size: 11px;
    }

    .custom-pagination {
        gap: 4px;
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


    function updateBulkDeleteButton() {

        const checkedItems =
            document.querySelectorAll(
                '.item-checkbox:checked'
            );

        const jumlah =
            checkedItems.length;


        bulkDeleteButton.disabled =
            jumlah === 0;


        if (jumlah > 0) {

            bulkDeleteText.textContent =
                'Hapus ' + jumlah + ' Data';

        } else {

            bulkDeleteText.textContent =
                'Hapus Terpilih';

        }


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


                if (jumlah === 0) {

                    alert(
                        'Silakan pilih minimal satu data yang ingin dihapus.'
                    );

                    return;

                }


                const konfirmasi = confirm(

                    'Apakah kamu yakin ingin menghapus ' +
                    jumlah +
                    ' data barang masuk yang dipilih?\n\n' +
                    'Data yang sudah dihapus tidak dapat dikembalikan.'

                );


                if (!konfirmasi) {

                    return;

                }


                bulkDeleteForm.submit();

            }
        );

    }


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


    updateBulkDeleteButton();

});

</script>

@endsection
