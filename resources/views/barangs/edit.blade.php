@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<style>
    /* =========================================================
       EDIT BARANG
    ========================================================= */

    .edit-page {
        width: 100%;
        max-width: 100%;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .edit-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .edit-title-icon {
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

    .edit-title {
        margin: 0;
        color: #1e293b;
        font-size: 24px;
        font-weight: 700;
        line-height: 1.2;
    }

    .edit-subtitle {
        margin: 5px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 40px;
        padding: 8px 16px;
        background: #ffffff;
        border: 1px solid #dfe3e8;
        border-radius: 8px;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all .2s ease;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .edit-alert {
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .edit-alert ul {
        padding-left: 20px;
    }

    .edit-alert-danger {
        background: #fff5f5;
        border: 1px solid #f3c7c7;
        color: #842029;
    }

    .edit-alert-success {
        background: #f4faf6;
        border: 1px solid #cce5d3;
        color: #25613b;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .05);
        overflow: hidden;
    }

    .form-card-header {
        padding: 20px 24px;
        background: #ffffff;
        border-bottom: 1px solid #eceef0;
    }

    .form-card-title {
        margin: 0;
        color: #1e293b;
        font-size: 17px;
        font-weight: 700;
    }

    .form-card-subtitle {
        display: block;
        margin-top: 4px;
        color: #94a3b8;
        font-size: 13px;
    }

    .form-card-body {
        padding: 26px 24px;
    }

    .form-card-footer {
        padding: 17px 24px;
        background: #fafafa;
        border-top: 1px solid #eceef0;
    }

    /* =========================================================
       FORM INPUT
    ========================================================= */

    .form-label {
        margin-bottom: 7px;
        color: #334155;
        font-size: 14px;
    }

    .form-control {
        min-height: 42px;
        padding: 9px 12px;
        border: 1px solid #dfe3e8;
        border-radius: 7px;
        color: #1e293b;
        background: #ffffff;
        font-size: 14px;
        box-shadow: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control::placeholder {
        color: #a8b0ba;
    }

    .form-control:focus {
        border-color: #c49a00;
        box-shadow: 0 0 0 3px rgba(196, 154, 0, .10);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, .08);
    }

    .field-help {
        display: block;
        margin-top: 6px;
        color: #94a3b8;
        font-size: 12px;
    }

    .invalid-feedback {
        font-size: 12px;
    }

    /* =========================================================
       BUTTON
    ========================================================= */

    .btn-cancel {
        min-height: 40px;
        padding: 8px 18px;
        background: #ffffff;
        border: 1px solid #dfe3e8;
        border-radius: 7px;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
    }

    .btn-save {
        min-height: 40px;
        padding: 8px 20px;
        background: #c49a00;
        border: 1px solid #c49a00;
        border-radius: 7px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-save:hover {
        background: #ad8700;
        border-color: #ad8700;
        color: #ffffff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .edit-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .edit-title {
            font-size: 21px;
        }

        .form-card-header,
        .form-card-body,
        .form-card-footer {
            padding-left: 18px;
            padding-right: 18px;
        }

        .form-card-footer .d-flex {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-save {
            width: 100%;
        }
    }
</style>


<div class="container-fluid edit-page">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="edit-header">

        <div class="edit-title-wrap">

            <div class="edit-title-icon">
                📦
            </div>

            <div>
                <h3 class="edit-title">
                    Edit Barang
                </h3>

                <p class="edit-subtitle">
                    Perbarui data barang yang tersedia di master barang.
                </p>
            </div>

        </div>

        <a
            href="{{ route('barangs.index') }}"
            class="btn-back"
        >
            ← Kembali
        </a>

    </div>


    {{-- ===================================================== --}}
    {{-- PESAN ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert edit-alert edit-alert-danger">

            <strong>
                Data belum dapat diperbarui.
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
    {{-- PESAN SUCCESS --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div class="alert alert-dismissible fade show edit-alert edit-alert-success">

            <div class="d-flex justify-content-between align-items-start gap-3">

                <div>

                    <strong>
                        Berhasil!
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
    {{-- FORM EDIT --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('barangs.update', $barang) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <div class="form-card">

            {{-- ================================================= --}}
            {{-- HEADER FORM --}}
            {{-- ================================================= --}}

            <div class="form-card-header">

                <h5 class="form-card-title">
                    Informasi Barang
                </h5>

                <small class="form-card-subtitle">
                    Ubah informasi barang sesuai dengan data terbaru.
                </small>

            </div>


            {{-- ================================================= --}}
            {{-- BODY --}}
            {{-- ================================================= --}}

            <div class="form-card-body">

                <div class="row g-4">


                    {{-- ================================================= --}}
                    {{-- NAMA BARANG --}}
                    {{-- ================================================= --}}

                    <div class="col-md-6">

                        <label
                            for="nama_barang"
                            class="form-label fw-semibold"
                        >
                            Nama Barang
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_barang"
                            name="nama_barang"
                            class="form-control @error('nama_barang') is-invalid @enderror"
                            placeholder="Contoh: Kipas Angin"
                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_barang')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="field-help">
                            Ubah nama barang jika diperlukan.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SATUAN --}}
                    {{-- ================================================= --}}

                    <div class="col-md-6">

                        <label
                            for="satuan"
                            class="form-label fw-semibold"
                        >
                            Satuan
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="satuan"
                            name="satuan"
                            class="form-control @error('satuan') is-invalid @enderror"
                            placeholder="Contoh: PCS, Unit, Box"
                            value="{{ old('satuan', $barang->satuan) }}"
                            maxlength="50"
                            required
                        >

                        @error('satuan')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="field-help">
                            Satuan dapat diubah secara manual.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JUMLAH KOLI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-6">

                        <label
                            for="jumlah_koli"
                            class="form-label fw-semibold"
                        >
                            Jumlah Koli
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            id="jumlah_koli"
                            name="jumlah_koli"
                            class="form-control @error('jumlah_koli') is-invalid @enderror"
                            placeholder="Contoh: 10"
                            value="{{ old('jumlah_koli', $barang->jumlah_koli ?? 0) }}"
                            min="0"
                            step="1"
                            required
                        >

                        @error('jumlah_koli')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="field-help">
                            Ubah jumlah koli sesuai data terbaru.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PCS PER KOLI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-6">

                        <label
                            for="pcs_per_koli"
                            class="form-label fw-semibold"
                        >
                            PCS per Koli
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            id="pcs_per_koli"
                            name="pcs_per_koli"
                            class="form-control @error('pcs_per_koli') is-invalid @enderror"
                            placeholder="Contoh: 2"
                            value="{{ old('pcs_per_koli', $barang->pcs_per_koli) }}"
                            min="1"
                            step="1"
                            required
                        >

                        @error('pcs_per_koli')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="field-help">
                            Masukkan jumlah PCS dalam setiap koli.
                        </small>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <div class="form-card-footer">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('barangs.index') }}"
                        class="btn btn-cancel"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-save"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection