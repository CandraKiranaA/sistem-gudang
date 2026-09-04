@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       PAGE
    ========================================================= */

    .barang-masuk-page {
        color: #374151;
    }

    .page-title {
        color: #374151;
        letter-spacing: -0.3px;
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
        background: linear-gradient(135deg, #fffbea, #fffdf7);
        border: 1px solid #f0e4ae;
        box-shadow: 0 4px 12px rgba(212, 167, 0, 0.08);
        font-size: 21px;
    }


    /* =========================================================
       BUTTON
    ========================================================= */

    .btn-outline-gold {
        border: 1px solid #d9bc42;
        color: #a18200;
        background: #fffdf7;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-outline-gold:hover {
        background: #fffbea;
        border-color: #cbaa27;
        color: #8b7000;
        transform: translateY(-1px);
    }

    .btn-gold {
        border: 1px solid #d4a700;
        background: linear-gradient(
            135deg,
            #d9b52e,
            #c99f00
        );
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(212, 167, 0, 0.16);
        transition: all 0.2s ease;
    }

    .btn-gold:hover {
        background: linear-gradient(
            135deg,
            #cda900,
            #b88f00
        );
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(212, 167, 0, 0.20);
    }

    .btn-secondary-custom {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-secondary-custom:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        color: #374151;
    }


    /* =========================================================
       MAIN CARD
    ========================================================= */

    .import-card {
        border: 1px solid #e8e9ec !important;
        border-radius: 16px !important;
        background: #fff;
        box-shadow: 0 5px 18px rgba(17, 24, 39, 0.055) !important;
        overflow: hidden;
    }

    .import-card-header {
        background: linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );
        border-bottom: 1px solid #eee7c9 !important;
        padding: 18px 20px;
    }

    .upload-icon {
        width: 46px;
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #fff;
        border: 1px solid #f0e4ae;
        box-shadow: 0 3px 10px rgba(212, 167, 0, 0.07);
        font-size: 22px;
    }

    .import-card-title {
        color: #4b5563;
        font-size: 15px;
    }

    .import-card-description {
        color: #9ca3af;
        font-size: 12px;
    }

    .import-card-body {
        padding: 24px 20px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-label {
        color: #4b5563;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        min-height: 43px;
        border: 1px solid #dfe2e7;
        border-radius: 10px;
        color: #374151;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #d9bc42;
        box-shadow: 0 0 0 3px rgba(212, 167, 0, 0.10);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }


    /* =========================================================
       UPLOAD AREA
    ========================================================= */

    .upload-area {
        border: 1.5px dashed #e1d48d !important;
        border-radius: 14px !important;
        background: linear-gradient(
            135deg,
            #fffdf7,
            #fffbea
        ) !important;
        padding: 28px 22px !important;
    }

    .upload-main-icon {
        width: 68px;
        height: 68px;
        margin: 0 auto 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: #fff;
        border: 1px solid #f0e4ae;
        box-shadow: 0 5px 14px rgba(212, 167, 0, 0.08);
        font-size: 32px !important;
    }

    .upload-title {
        color: #4b5563;
        font-size: 15px;
    }

    .upload-description {
        color: #9ca3af;
    }

    .upload-limit {
        color: #9ca3af;
        font-size: 12px;
    }

    .upload-limit strong {
        color: #8b7000;
    }


    /* =========================================================
       INFORMATION ALERT
    ========================================================= */

    .format-alert {
        background: #fffdf7;
        border: 1px solid #eee4b5 !important;
        color: #4b5563;
        border-radius: 13px;
    }

    .format-icon,
    .warning-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #fff;
        border: 1px solid #f0e4ae;
        font-size: 19px !important;
    }

    .format-alert h6,
    .warning-alert h6 {
        color: #4b5563;
    }

    .format-alert p,
    .warning-alert p {
        color: #6b7280;
    }


    /* =========================================================
       EXCEL TABLE
    ========================================================= */

    .excel-table-wrapper {
        border: 1px solid #e5e7eb;
        border-radius: 11px;
        overflow: hidden;
        background: #fff;
    }

    .excel-table {
        margin-bottom: 0 !important;
        font-size: 12px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .excel-table thead th {
        background: #fffbea !important;
        color: #8b7000;
        border-bottom: 1px solid #eadb8b;
        border-color: #eee8cc;
        font-weight: 700;
        padding: 10px 12px;
    }

    .excel-table tbody td {
        border-color: #eeeef0;
        color: #6b7280;
        padding: 10px 12px;
    }

    .excel-table tbody tr:hover {
        background: #fffdf7;
    }


    /* =========================================================
       WARNING
    ========================================================= */

    .warning-alert {
        background: #fffdf7;
        border: 1px solid #eadb8b !important;
        color: #6b7280;
        border-radius: 13px;
    }

    .warning-alert strong {
        color: #8b7000;
    }


    /* =========================================================
       COLUMN ORDER
    ========================================================= */

    .column-order {
        display: block;
        padding: 10px 12px;
        border-radius: 9px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        color: #6b7280;
        line-height: 1.7;
    }


    /* =========================================================
       ACTION AREA
    ========================================================= */

    .import-actions {
        padding-top: 4px;
    }


    /* =========================================================
       ALERT GENERAL
    ========================================================= */

    .alert {
        border-radius: 12px;
        font-size: 14px;
    }

    .alert-success {
        background: #f5fbf7;
        border-color: #cfe8d7;
        color: #24613a;
    }

    .alert-danger {
        background: #fff7f7;
        border-color: #f3d0d0;
        color: #842029;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767.98px) {

        .page-title {
            font-size: 21px;
        }

        .page-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            font-size: 19px;
        }

        .import-card-header {
            padding: 16px;
        }

        .import-card-body {
            padding: 18px 16px;
        }

        .upload-area {
            padding: 22px 16px !important;
        }

        .import-actions {
            flex-direction: column-reverse;
        }

        .import-actions .btn {
            width: 100%;
        }

    }
</style>


<div class="container-fluid px-2 px-md-3 barang-masuk-page">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="page-icon">
                📥
            </div>

            <div>

                <h3 class="fw-bold mb-1 page-title">
                    Import Barang Masuk
                </h3>

                <p class="page-subtitle mb-0">
                    Tambahkan banyak data barang masuk ke gudang menggunakan file Excel.
                </p>

            </div>

        </div>


        <div class="d-flex gap-2 mt-3 mt-md-0">

            {{-- KEMBALI --}}
            <a
                href="{{ route('barang-masuk.index') }}"
                class="btn btn-outline-gold px-3"
            >
                ← Kembali
            </a>


            {{-- TAMBAH MANUAL --}}
            <a
                href="{{ route('barang-masuk.create') }}"
                class="btn btn-gold px-3"
            >
                + Tambah Manual
            </a>

        </div>

    </div>


    {{-- ===================================================== --}}
    {{-- PESAN SUKSES --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <strong>Import berhasil!</strong>

            <div class="mt-1">
                {{ session('success') }}
            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- PESAN ERROR --}}
    {{-- ===================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show shadow-sm"
            role="alert"
        >

            <strong>Import gagal!</strong>

            <div class="mt-1">
                {{ session('error') }}
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

        <div class="alert alert-danger shadow-sm">

            <strong>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- CARD UTAMA --}}
    {{-- ===================================================== --}}

    <div class="card import-card">

    <div class="import-card-header">

            <div class="import-card-header-inner">

                <div>

                    <h5 class="import-card-title">
                        Upload File Excel
                    </h5>

                    <small class="import-card-subtitle">
                        Pilih file Excel untuk memasukkan data barang masuk secara massal.
                    </small>

                </div>

            </div>

        </div>

        {{-- ================================================= --}}
        {{-- BODY --}}
        {{-- ================================================= --}}

        <div class="card-body import-card-body">

            <form
                action="{{ route('barang-masuk.import') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- AREA UPLOAD --}}
                {{-- ================================================= --}}

                <div class="mb-4">

                    <label
                        for="file"
                        class="form-label fw-semibold"
                    >
                        File Excel
                    </label>


                    <div class="upload-area text-center">


                        <div class="upload-main-icon">
                            📊
                        </div>


                        <h6 class="fw-semibold upload-title mb-2">
                            Pilih file Excel
                        </h6>


                        <p class="upload-description small mb-3">
                            Format XLSX, XLS, atau CSV
                        </p>


                        <input
                            type="file"
                            id="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".xlsx,.xls,.csv"
                            required
                        >


                        @error('file')

                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="mt-3">

                            <small class="upload-limit">

                                Ukuran maksimal:

                                <strong>
                                    100 MB
                                </strong>

                            </small>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- FORMAT DATA EXCEL --}}
                {{-- ================================================= --}}

                <div class="alert format-alert border-0 mb-4">

                    <div class="d-flex">

                        <div class="format-icon me-3">
                            📋
                        </div>


                        <div class="w-100">

                            <h6 class="fw-bold mb-2">
                                Format Kolom Excel
                            </h6>


                            <p class="small mb-3">

                                Pastikan baris pertama pada file Excel
                                menggunakan nama kolom berikut:

                            </p>


                            <div class="table-responsive excel-table-wrapper">

                                <table class="table table-sm excel-table">

                                    <thead>

                                        <tr>

                                            {{-- TANGGAL --}}
                                            <th>
                                                tanggal_input
                                            </th>


                                            {{-- BARANG --}}
                                            <th>
                                                nama_barang
                                            </th>


                                            {{-- EDISI --}}
                                            <th>
                                                edisi
                                            </th>


                                            {{-- KOLI --}}
                                            <th>
                                                jumlah_koli
                                            </th>


                                            {{-- HARGA BELI --}}
                                            <th>
                                                harga_beli_koli
                                            </th>


                                            {{-- HARGA JUAL KOLI --}}
                                            <th>
                                                harga_jual_koli
                                            </th>


                                            {{-- HARGA JUAL PCS --}}
                                            <th>
                                                harga_jual_pcs
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        {{-- ================================================= --}}
                                        {{-- CONTOH 1 --}}
                                        {{-- ================================================= --}}

                                        <tr>

                                            <td>
                                                2026-08-25 08:30:00
                                            </td>

                                            <td>
                                                Kipas Angin
                                            </td>

                                            <td>
                                                Edisi A
                                            </td>

                                            <td>
                                                10
                                            </td>

                                            <td>
                                                500000
                                            </td>

                                            <td>
                                                600000
                                            </td>

                                            <td>
                                                300000
                                            </td>

                                        </tr>


                                        {{-- ================================================= --}}
                                        {{-- CONTOH 2 --}}
                                        {{-- ================================================= --}}

                                        <tr>

                                            <td>
                                                2026-08-25 09:15:00
                                            </td>

                                            <td>
                                                Lemari
                                            </td>

                                            <td>
                                                Edisi B
                                            </td>

                                            <td>
                                                5
                                            </td>

                                            <td>
                                                1000000
                                            </td>

                                            <td>
                                                1200000
                                            </td>

                                            <td>
                                                600000
                                            </td>

                                        </tr>


                                        {{-- ================================================= --}}
                                        {{-- CONTOH 3 --}}
                                        {{-- ================================================= --}}

                                        <tr>

                                            <td>
                                                2026-08-25 10:00:00
                                            </td>

                                            <td>
                                                Meja
                                            </td>

                                            <td>
                                                Edisi C
                                            </td>

                                            <td>
                                                8
                                            </td>

                                            <td>
                                                400000
                                            </td>

                                            <td>
                                                500000
                                            </td>

                                            <td>
                                                250000
                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            {{-- ================================================= --}}
                            {{-- KETERANGAN FORMAT --}}
                            {{-- ================================================= --}}

                            <div class="mt-3">

                                <small class="column-order">

                                    <strong>Urutan kolom:</strong>

                                    tanggal_input →
                                    nama_barang →
                                    edisi →
                                    jumlah_koli →
                                    harga_beli_koli →
                                    harga_jual_koli →
                                    harga_jual_pcs

                                </small>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- INFORMASI PCS --}}
                {{-- ================================================= --}}

                <div class="alert warning-alert border-0 mb-4">

                    <div class="d-flex">

                        <div class="warning-icon me-3">
                            ⚠️
                        </div>


                        <div>

                            <h6 class="fw-bold mb-2">
                                Perhitungan PCS Otomatis
                            </h6>


                            <p class="small mb-0">

                                Jumlah PCS tidak perlu dimasukkan ke Excel.

                                Sistem akan menghitung otomatis berdasarkan

                                <strong>
                                    jumlah_koli
                                </strong>

                                dan

                                <strong>
                                    pcs_per_koli
                                </strong>

                                dari Master Barang.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <div class="d-flex justify-content-end gap-2 import-actions">

                    <a
                        href="{{ route('barang-masuk.index') }}"
                        class="btn btn-secondary-custom px-4"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="btn btn-gold px-4"
                    >
                        📥 Import Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection