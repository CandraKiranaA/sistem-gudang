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
       CARD
    ========================================================= */

    .form-card {
        border: 1px solid #e8e9ec !important;
        border-radius: 16px !important;
        background: #fff;
        box-shadow: 0 5px 18px rgba(17, 24, 39, 0.055) !important;
        overflow: hidden;
    }

    .form-card-header {
        background: linear-gradient(
            135deg,
            #fffbea,
            #fffdf7
        );
        border-bottom: 1px solid #eee7c9 !important;
        padding: 17px 20px;
    }

    .form-card-header h5 {
        color: #4b5563;
        font-size: 15px;
    }

    .section-icon {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #f0e4ae;
        font-size: 16px;
    }

    .form-card-body {
        padding: 22px 20px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-label {
        color: #4b5563;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        min-height: 43px;
        border: 1px solid #dfe2e7;
        border-radius: 10px;
        color: #374151;
        background-color: #fff;
        font-size: 14px;
        transition: all 0.2s ease;
        box-shadow: none;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #d9bc42;
        box-shadow: 0 0 0 3px rgba(212, 167, 0, 0.10);
    }

    .form-control::placeholder {
        color: #b4b8bf;
    }

    .form-control.bg-light {
        background: #f8f9fa !important;
        color: #6b7280;
    }

    .form-text-custom {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }

    .form-text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }


    /* =========================================================
       INPUT GROUP
    ========================================================= */

    .input-group-text {
        min-height: 43px;
        border: 1px solid #dfe2e7;
        background: #f8f9fa;
        color: #8b7000;
        font-size: 13px;
        font-weight: 700;
        border-radius: 10px 0 0 10px;
    }

    .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }

    .input-group:focus-within .input-group-text {
        border-color: #d9bc42;
        background: #fffbea;
    }


    /* =========================================================
       QUANTITY
    ========================================================= */

    .pcs-field {
        background: #fffbea !important;
        border-color: #eadb8b !important;
        color: #8b7000 !important;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert {
        border-radius: 12px;
        border: 1px solid transparent;
        font-size: 14px;
    }

    .alert-danger {
        background: #fff7f7;
        border-color: #f3d0d0;
        color: #842029;
    }

    .alert-success {
        background: #f5fbf7;
        border-color: #cfe8d7;
        color: #24613a;
    }


    /* =========================================================
       BOTTOM ACTION
    ========================================================= */

    .form-actions {
        padding: 16px 18px;
        background: #fff;
        border: 1px solid #e8e9ec;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(17, 24, 39, 0.04);
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

        .form-card-body {
            padding: 18px 16px;
        }

        .form-card-header {
            padding: 15px 16px;
        }

        .form-actions {
            padding: 14px;
        }

        .form-actions .btn {
            flex: 1;
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
                📦
            </div>

            <div>
                <h3 class="fw-bold mb-1 page-title">
                    Tambah Barang Masuk
                </h3>

                <p class="page-subtitle mb-0">
                    Input data barang yang masuk ke gudang.
                </p>
            </div>

        </div>

        <a
            href="{{ route('barang-masuk.index') }}"
            class="btn btn-outline-gold mt-3 mt-md-0 px-3"
        >
            ← Kembali
        </a>

    </div>


    {{-- ===================================================== --}}
    {{-- ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger shadow-sm mb-4">

            <strong>
                Data belum dapat disimpan.
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
    {{-- SUCCESS --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div class="alert alert-success shadow-sm mb-4">
            {{ session('success') }}
        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('barang-masuk.store') }}"
        method="POST"
    >

        @csrf


        {{-- ================================================= --}}
        {{-- INFORMASI BARANG --}}
        {{-- ================================================= --}}

        <div class="card form-card mb-4">

            <div class="card-header form-card-header">

                <div class="d-flex align-items-center gap-2">

                    <h5 class="mb-0 fw-bold">
                        Informasi Barang
                    </h5>

                </div>

            </div>


            <div class="card-body form-card-body">

     <div class="row g-4">

    {{-- TANGGAL INPUT --}}
    <div class="col-md-4">

        <label class="form-label fw-semibold">
            Tanggal Input
        </label>

        <input
            type="date"
            name="tanggal_input"
            class="form-control"
            value="{{ old(
                'tanggal_input',
                date('Y-m-d')
            ) }}"
            required
        >

    </div>


    {{-- NAMA BARANG --}}
    <div class="col-md-8">

        <label class="form-label fw-semibold">
            Nama Barang
        </label>

        <select
            name="barang_id"
            id="barang_id"
            class="form-select"
            required
        >

            <option value="">
                -- Pilih Barang --
            </option>

            @forelse($barangs as $barang)

                <option
                    value="{{ $barang->id }}"
                    data-satuan="{{ $barang->satuan }}"
                    {{ old('barang_id') == $barang->id
                        ? 'selected'
                        : '' }}
                >
                    {{ $barang->nama_barang }}
                </option>

            @empty

                <option
                    value=""
                    disabled
                >
                    Belum ada data barang
                </option>

            @endforelse

        </select>


        @if($barangs->isEmpty())

            <small class="form-text-danger">
                Belum ada master barang.
                Silakan tambahkan barang terlebih dahulu
                melalui menu Data Barang.
            </small>

        @else

            <small class="form-text-custom">
                Data barang diambil dari Master Barang.
            </small>

        @endif

    </div>


    {{-- SATUAN --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Satuan
        </label>

        <input
            type="text"
            id="satuan"
            class="form-control bg-light"
            value=""
            readonly
        >

        <small class="form-text-custom">
            Diambil otomatis dari Master Barang.
        </small>

    </div>


    {{-- JUMLAH KOLI --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Jumlah Koli
        </label>

        <input
            type="number"
            name="jumlah_koli"
            id="jumlah_koli"
            class="form-control"
            min="1"
            value="{{ old('jumlah_koli', 1) }}"
            required
        >

        <small class="form-text-custom">
            Masukkan jumlah koli barang yang masuk.
        </small>

    </div>


    {{-- JUMLAH PCS --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Jumlah PCS
        </label>

        <input
            type="number"
            id="jumlah_pcs"
            class="form-control pcs-field fw-bold"
            value="{{ old('jumlah_koli', 1) * 2 }}"
            readonly
        >

        <small class="form-text-custom">
            Otomatis dihitung 2 PCS × jumlah koli.
        </small>

    </div>

</div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- INFORMASI HARGA --}}
        {{-- ================================================= --}}

        <div class="card form-card mb-4">

            <div class="card-header form-card-header">

                <div class="d-flex align-items-center gap-2">

                    <span class="section-icon">
                        💰
                    </span>

                    <h5 class="mb-0 fw-bold">
                        Informasi Harga
                    </h5>

                </div>

            </div>


            <div class="card-body form-card-body">

                <div class="row g-4">


                    {{-- HARGA BELI --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Beli / Koli
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga_beli_koli"
                                class="form-control"
                                min="0"
                                value="{{ old(
                                    'harga_beli_koli',
                                    0
                                ) }}"
                                required
                            >

                        </div>

                    </div>


                    {{-- HARGA JUAL KOLI --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Jual / Koli
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga_jual_koli"
                                class="form-control"
                                min="0"
                                value="{{ old(
                                    'harga_jual_koli',
                                    0
                                ) }}"
                                required
                            >

                        </div>

                    </div>


                    {{-- HARGA JUAL PCS --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Jual / PCS
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga_jual_pcs"
                                class="form-control"
                                min="0"
                                value="{{ old(
                                    'harga_jual_pcs',
                                    0
                                ) }}"
                                required
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BUTTON --}}
        {{-- ================================================= --}}

        <div class="form-actions d-flex justify-content-end gap-2 mb-4">

            <a
                href="{{ route('barang-masuk.index') }}"
                class="btn btn-secondary-custom px-4"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-gold px-4"
                {{ $barangs->isEmpty() ? 'disabled' : '' }}
            >
                💾 Simpan Barang Masuk
            </button>

        </div>

    </form>

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const barangSelect = document.getElementById('barang_id');

    const satuan = document.getElementById('satuan');

    const jumlahKoli = document.getElementById('jumlah_koli');

    const jumlahPcs = document.getElementById('jumlah_pcs');


    /*
    |--------------------------------------------------------------------------
    | Update Satuan
    |--------------------------------------------------------------------------
    */

    function updateBarang() {

        const selected =
            barangSelect.options[
                barangSelect.selectedIndex
            ];

        if (!selected || !selected.value) {

            satuan.value = '';

            return;
        }

        satuan.value =
            selected.dataset.satuan || '';

    }


    /*
    |--------------------------------------------------------------------------
    | Hitung Jumlah PCS
    |--------------------------------------------------------------------------
    |
    | 1 Koli = 2 PCS
    |
    | Contoh:
    |
    | 1 Koli = 2 PCS
    | 2 Koli = 4 PCS
    | 3 Koli = 6 PCS
    | 5 Koli = 10 PCS
    |
    */

    function hitungPcs() {

        const koli =
            parseInt(
                jumlahKoli.value
            ) || 0;

        const pcs =
            koli * 2;

        jumlahPcs.value = pcs;

    }


    /*
    |--------------------------------------------------------------------------
    | Event pilih barang
    |--------------------------------------------------------------------------
    */

    barangSelect.addEventListener(
        'change',
        updateBarang
    );


    /*
    |--------------------------------------------------------------------------
    | Event jumlah koli berubah
    |--------------------------------------------------------------------------
    */

    jumlahKoli.addEventListener(
        'input',
        hitungPcs
    );


    /*
    |--------------------------------------------------------------------------
    | Jalankan saat halaman dibuka
    |--------------------------------------------------------------------------
    */

    updateBarang();

    hitungPcs();

});

</script>

@endsection