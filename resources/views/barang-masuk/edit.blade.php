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

    .form-card-body {
        padding: 22px 20px;
    }

    .form-card-footer {
        background: #fafafa;
        border-top: 1px solid #e8e9ec !important;
        padding: 15px 20px;
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

    .form-control[readonly] {
        background: #f8f9fa;
        color: #6b7280;
    }

    .form-text-custom {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 6px;
        display: block;
    }


    /* =========================================================
       PCS FIELD
    ========================================================= */

    #pcs_per_koli,
    #jumlah_pcs {
        background: #fffbea !important;
        border-color: #eadb8b !important;
        color: #8b7000 !important;
        font-weight: 700;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert {
        border-radius: 12px;
        font-size: 14px;
        border: 1px solid transparent;
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

        .form-card-body {
            padding: 18px 16px;
        }

        .form-card-footer {
            padding: 14px 16px;
        }

        .form-card-footer .btn {
            padding-left: 18px !important;
            padding-right: 18px !important;
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
                    Edit Barang Masuk
                </h3>

                <p class="page-subtitle mb-0">
                    Perbarui data barang yang masuk ke gudang.
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
    {{-- FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('barang-masuk.update', $barangMasuk) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="card form-card">


            <div class="card-body form-card-body">

                <div class="row g-4">


                    {{-- ================================================= --}}
                    {{-- TANGGAL INPUT --}}
                    {{-- ================================================= --}}

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
                                $barangMasuk->tanggal_input->format('Y-m-d')
                            ) }}"
                            required
                        >

                    </div>


                    {{-- ================================================= --}}
                    {{-- NAMA BARANG --}}
                    {{-- ================================================= --}}

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

                            @foreach($barangs as $barang)

                                <option
                                    value="{{ $barang->id }}"
                                    data-pcs="{{ $barang->pcs_per_koli }}"
                                    {{ old(
                                        'barang_id',
                                        $barangMasuk->barang_id
                                    ) == $barang->id ? 'selected' : '' }}
                                >

                                    {{ $barang->kode_barang }}
                                    -
                                    {{ $barang->nama_barang }}

                                </option>

                            @endforeach

                        </select>

                        <small class="form-text-custom">
                            Pilih barang dari Master Barang.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- EDISI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Edisi
                        </label>

                        <input
                            type="text"
                            name="edisi"
                            class="form-control"
                            placeholder="Contoh: Edisi 2026"
                            value="{{ old(
                                'edisi',
                                $barangMasuk->edisi
                            ) }}"
                            maxlength="100"
                        >

                        <small class="form-text-custom">
                            Isi edisi jika barang memiliki edisi.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PCS / KOLI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            PCS / Koli
                        </label>

                        <input
                            type="number"
                            id="pcs_per_koli"
                            class="form-control"
                            value="{{ $barangMasuk->barang->pcs_per_koli }}"
                            readonly
                        >

                        <small class="form-text-custom">
                            Diambil otomatis dari Master Barang.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JUMLAH KOLI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Jumlah Koli
                        </label>

                        <input
                            type="number"
                            name="jumlah_koli"
                            id="jumlah_koli"
                            class="form-control"
                            min="1"
                            value="{{ old(
                                'jumlah_koli',
                                $barangMasuk->jumlah_koli
                            ) }}"
                            required
                        >

                        <small class="form-text-custom">
                            Masukkan jumlah koli barang yang masuk.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- JUMLAH PCS --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Jumlah PCS
                        </label>

                        <input
                            type="number"
                            id="jumlah_pcs"
                            class="form-control"
                            value="{{ $barangMasuk->jumlah_pcs }}"
                            readonly
                        >

                        <small class="form-text-custom">
                            Dihitung otomatis berdasarkan PCS / Koli.
                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- HARGA BELI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Beli / Koli
                        </label>

                        <input
                            type="number"
                            name="harga_beli_koli"
                            class="form-control"
                            value="{{ old(
                                'harga_beli_koli',
                                $barangMasuk->harga_beli_koli
                            ) }}"
                            required
                        >

                    </div>


                    {{-- ================================================= --}}
                    {{-- HARGA JUAL KOLI --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Jual / Koli
                        </label>

                        <input
                            type="number"
                            name="harga_jual_koli"
                            class="form-control"
                            value="{{ old(
                                'harga_jual_koli',
                                $barangMasuk->harga_jual_koli
                            ) }}"
                            required
                        >

                    </div>


                    {{-- ================================================= --}}
                    {{-- HARGA JUAL PCS --}}
                    {{-- ================================================= --}}

                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga Jual / PCS
                        </label>

                        <input
                            type="number"
                            name="harga_jual_pcs"
                            class="form-control"
                            value="{{ old(
                                'harga_jual_pcs',
                                $barangMasuk->harga_jual_pcs
                            ) }}"
                            required
                        >

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <div class="card-footer form-card-footer text-end">

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="btn btn-secondary-custom px-4"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-gold px-4 ms-1"
                >
                    💾 Update
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const barang =
        document.getElementById('barang_id');

    const pcsPerKoli =
        document.getElementById('pcs_per_koli');

    const koli =
        document.getElementById('jumlah_koli');

    const pcs =
        document.getElementById('jumlah_pcs');


    function hitung() {

        const option =
            barang.options[
                barang.selectedIndex
            ];

        const perKoli =
            parseInt(option.dataset.pcs) || 1;

        const jumlahKoli =
            parseInt(koli.value) || 0;

        pcsPerKoli.value =
            perKoli;

        pcs.value =
            jumlahKoli * perKoli;
    }


    barang.addEventListener(
        'change',
        hitung
    );


    koli.addEventListener(
        'input',
        hitung
    );


    hitung();

});

</script>

@endsection