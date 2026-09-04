@extends('layouts.app')

@section('title', 'Import Data Barang')

@section('content')

<style>
    /* =========================================================
       IMPORT BARANG
    ========================================================= */

    .import-page {
        width: 100%;
        max-width: 100%;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .import-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .import-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .import-title-icon {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fffbea;
        border: 1px solid #f0e4a8;
        border-radius: 10px;
        font-size: 21px;
        flex-shrink: 0;
    }

    .import-title {
        margin: 0;
        color: #1e293b;
        font-size: 24px;
        font-weight: 700;
        line-height: 1.2;
    }

    .import-subtitle {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* =========================================================
       BUTTON
    ========================================================= */

    .btn-back,
    .btn-manual,
    .btn-cancel,
    .btn-import {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-back {
        padding: 8px 16px;
        background: #ffffff;
        border: 1px solid #dfe3e8;
        color: #475569;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
    }

    .btn-manual {
        padding: 8px 16px;
        background: #c49a00;
        border: 1px solid #c49a00;
        color: #ffffff;
    }

    .btn-manual:hover {
        background: #ad8700;
        border-color: #ad8700;
        color: #ffffff;
    }

    .btn-cancel {
        padding: 8px 18px;
        background: #ffffff;
        border: 1px solid #dfe3e8;
        color: #475569;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
    }

    .btn-import {
        padding: 8px 20px;
        background: #c49a00;
        border: 1px solid #c49a00;
        color: #ffffff;
        font-weight: 600;
    }

    .btn-import:hover {
        background: #ad8700;
        border-color: #ad8700;
        color: #ffffff;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .import-alert {
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .import-alert-success {
        background: #f4faf6;
        border: 1px solid #cce5d3;
        color: #25613b;
    }

    .import-alert-danger {
        background: #fff5f5;
        border: 1px solid #f3c7c7;
        color: #842029;
    }

    .import-alert ul {
        padding-left: 20px;
    }

    /* =========================================================
       MAIN FORM
    ========================================================= */

    .import-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .05);
        overflow: hidden;
    }

    .import-card-header {
        padding: 20px 24px;
        background: #ffffff;
        border-bottom: 1px solid #eceef0;
    }

    .import-card-header-inner {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .upload-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fffbea;
        border: 1px solid #f0e4a8;
        border-radius: 9px;
        font-size: 20px;
        flex-shrink: 0;
    }

    .import-card-title {
        margin: 0;
        color: #1e293b;
        font-size: 17px;
        font-weight: 700;
    }

    .import-card-subtitle {
        display: block;
        margin-top: 4px;
        color: #94a3b8;
        font-size: 13px;
    }

    .import-card-body {
        padding: 26px 24px;
    }

    /* =========================================================
       FILE UPLOAD
    ========================================================= */

    .form-label {
        margin-bottom: 8px;
        color: #334155;
        font-size: 14px;
    }

    .upload-area {
        padding: 25px;
        background: #fafafa;
        border: 1px dashed #d7dbe0;
        border-radius: 9px;
        text-align: center;
    }

    .upload-area-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        background: #fffbea;
        border: 1px solid #f0e4a8;
        border-radius: 10px;
        font-size: 25px;
    }

    .upload-title {
        margin-bottom: 5px;
        color: #334155;
        font-size: 15px;
        font-weight: 600;
    }

    .upload-description {
        margin-bottom: 16px;
        color: #94a3b8;
        font-size: 13px;
    }

    .file-input {
        max-width: 650px;
        margin: 0 auto;
        background: #ffffff;
        border-color: #dfe3e8;
        border-radius: 7px;
        font-size: 14px;
        box-shadow: none;
    }

    .file-input:focus {
        border-color: #c49a00;
        box-shadow: 0 0 0 3px rgba(196, 154, 0, .10);
    }

    .file-input.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 12px;
    }

    .file-limit {
        margin-top: 12px;
        color: #94a3b8;
        font-size: 12px;
    }

    .file-limit strong {
        color: #64748b;
    }

    /* =========================================================
       CONTOH FORMAT EXCEL
    ========================================================= */

    .example-section {
        margin-top: 24px;
        padding: 20px;
        background: #fffdf5;
        border: 1px solid #eee5bd;
        border-radius: 9px;
    }

    .example-header {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }

    .example-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 1px solid #eee5bd;
        border-radius: 8px;
        font-size: 18px;
        flex-shrink: 0;
    }

    .example-title {
        margin: 0;
        color: #334155;
        font-size: 15px;
        font-weight: 700;
    }

    .example-description {
        margin: 4px 0 0;
        color: #64748b;
        font-size: 13px;
    }

    .example-table-wrap {
        overflow-x: auto;
        border: 1px solid #e5e7eb;
        border-radius: 7px;
        background: #ffffff;
    }

    .example-table {
        margin: 0;
        min-width: 650px;
        font-size: 13px;
    }

    .example-table thead th {
        padding: 11px 12px;
        background: #f8f8f6;
        border-bottom: 1px solid #e5e7eb;
        color: #475569;
        font-weight: 600;
        white-space: nowrap;
    }

    .example-table tbody td {
        padding: 10px 12px;
        border-color: #eceef0;
        color: #475569;
        vertical-align: middle;
    }

    .example-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .example-table tbody tr:hover {
        background: #fffdf5;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .import-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 24px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .import-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions a {
            flex: 1;
        }

        .import-title {
            font-size: 21px;
        }

        .import-card-header,
        .import-card-body {
            padding-left: 18px;
            padding-right: 18px;
        }

        .upload-area {
            padding: 20px 15px;
        }

        .example-section {
            padding: 16px;
        }

        .import-actions {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-import {
            width: 100%;
        }
    }
</style>


<div class="container-fluid import-page">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="import-header">

        <div class="import-title-wrap">

            <div class="import-title-icon">
                📥
            </div>

            <div>

                <h3 class="import-title">
                    Import Data Barang
                </h3>

                <p class="import-subtitle">
                    Tambahkan banyak data barang ke Master Barang menggunakan file Excel.
                </p>

            </div>

        </div>


        <div class="header-actions">

            <a
                href="{{ route('barangs.index') }}"
                class="btn-back"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('barangs.create') }}"
                class="btn-manual"
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
            class="alert alert-dismissible fade show import-alert import-alert-success"
            role="alert"
        >

            <div class="d-flex justify-content-between align-items-start gap-3">

                <div>

                    <strong>
                        Import berhasil!
                    </strong>

                    <div class="mt-1">
                        {{ session('success') }}
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- PESAN ERROR --}}
    {{-- ===================================================== --}}

    @if(session('error'))

        <div
            class="alert alert-dismissible fade show import-alert import-alert-danger"
            role="alert"
        >

            <div class="d-flex justify-content-between align-items-start gap-3">

                <div>

                    <strong>
                        Import gagal!
                    </strong>

                    <div class="mt-1">
                        {{ session('error') }}
                    </div>

                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- VALIDATION ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert import-alert import-alert-danger">

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

    <div class="import-card">

        {{-- ================================================= --}}
        {{-- HEADER CARD --}}
        {{-- ================================================= --}}

        <div class="import-card-header">

            <div class="import-card-header-inner">

                <div>

                    <h5 class="import-card-title">
                        Upload File Excel
                    </h5>

                    <small class="import-card-subtitle">
                        Pilih file Excel untuk memasukkan data barang secara massal.
                    </small>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BODY --}}
        {{-- ================================================= --}}

        <div class="import-card-body">

            <form
                action="{{ route('barangs.import') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- AREA UPLOAD --}}
                {{-- ================================================= --}}

                <div class="mb-0">

                    <label
                        for="file"
                        class="form-label fw-semibold"
                    >
                        File Excel
                        <span class="text-danger">*</span>
                    </label>


                    <div class="upload-area">

                        <div class="upload-area-icon">
                            📊
                        </div>

                        <div class="upload-title">
                            Pilih file Excel
                        </div>

                        <p class="upload-description">
                            Format XLSX, XLS, atau CSV
                        </p>


                        <input
                            type="file"
                            id="file"
                            name="file"
                            class="form-control file-input @error('file') is-invalid @enderror"
                            accept=".xlsx,.xls,.csv"
                            required
                        >


                        @error('file')

                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="file-limit">
                            Ukuran maksimal:
                            <strong>100 MB</strong>
                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CONTOH FORMAT EXCEL --}}
                {{-- ================================================= --}}

                <div class="example-section">

                    <div class="example-header">

                        <div class="example-icon">
                            📋
                        </div>

                        <div>

                            <h6 class="example-title">
                                Contoh Format Data Excel
                            </h6>

                            <p class="example-description">
                                Berikut contoh format data yang dapat digunakan
                                untuk import barang.
                            </p>

                        </div>

                    </div>


                    <div class="example-table-wrap">

                        <table class="table example-table">

                            <thead>

                                <tr>

                                    <th>
                                        nama_barang
                                    </th>

                                    <th>
                                        satuan
                                    </th>

                                    <th>
                                        jumlah_koli
                                    </th>

                                    <th>
                                        pcs_per_koli
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>
                                        Kipas Angin
                                    </td>

                                    <td>
                                        PCS
                                    </td>

                                    <td>
                                        10
                                    </td>

                                    <td>
                                        2
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        Lemari
                                    </td>

                                    <td>
                                        PCS
                                    </td>

                                    <td>
                                        5
                                    </td>

                                    <td>
                                        1
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        Meja
                                    </td>

                                    <td>
                                        PCS
                                    </td>

                                    <td>
                                        8
                                    </td>

                                    <td>
                                        2
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <div class="import-actions">

                    <a
                        href="{{ route('barangs.index') }}"
                        class="btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn-import"
                    >
                        📥 Import Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection