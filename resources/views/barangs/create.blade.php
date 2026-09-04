@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<div class="container-fluid create-page px-3 px-md-4 py-3">

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
                    Tambah Barang
                </h3>

                <p class="page-subtitle">
                    Tambahkan data barang baru ke master barang.
                </p>

            </div>

        </div>


        <a
            href="{{ route('barangs.index') }}"
            class="back-button"
        >
            ←
            <span>Kembali</span>
        </a>

    </div>


    {{-- =====================================================
         ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="custom-alert alert-danger">

            <div class="alert-content">

                <div class="alert-icon">
                    !
                </div>

                <div>

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

            </div>

        </div>

    @endif


    {{-- =====================================================
         FORM
    ====================================================== --}}

    <form
        action="{{ route('barangs.store') }}"
        method="POST"
    >

        @csrf

        <div class="form-card">

            {{-- =================================================
                 FORM HEADER
            ================================================== --}}

            <div class="form-header">

                <div>

                    <h5>
                        Informasi Barang
                    </h5>

                    <p>
                        Isi data barang sesuai informasi yang tersedia.
                    </p>

                </div>

            </div>


            {{-- =================================================
                 FORM BODY
            ================================================== --}}

            <div class="form-body">

                <div class="row g-4">


                    {{-- =================================================
                         NAMA BARANG
                    ================================================== --}}

                    <div class="col-md-6">

                        <label
                            for="nama_barang"
                            class="form-label"
                        >
                            Nama Barang
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama_barang"
                            name="nama_barang"
                            class="form-control custom-input @error('nama_barang') is-invalid @enderror"
                            placeholder="Contoh: Kipas Angin"
                            value="{{ old('nama_barang') }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_barang')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="form-help">
                            Masukkan nama barang yang akan disimpan.
                        </small>

                    </div>


                    {{-- =================================================
                         SATUAN
                    ================================================== --}}

                    <div class="col-md-6">

                        <label
                            for="satuan"
                            class="form-label"
                        >
                            Satuan
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="satuan"
                            name="satuan"
                            class="form-control custom-input @error('satuan') is-invalid @enderror"
                            placeholder="Contoh: PCS, Unit, Box"
                            value="{{ old('satuan') }}"
                            maxlength="50"
                            required
                        >

                        @error('satuan')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="form-help">
                            Satuan dapat diisi secara manual.
                        </small>

                    </div>


                    {{-- =================================================
                         JUMLAH KOLI
                    ================================================== --}}

                    <div class="col-md-6">

                        <label
                            for="jumlah_koli"
                            class="form-label"
                        >
                            Jumlah Koli
                            <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="jumlah_koli"
                            name="jumlah_koli"
                            class="form-control custom-input @error('jumlah_koli') is-invalid @enderror"
                            placeholder="Masukkan jumlah koli"
                            value="{{ old('jumlah_koli', 0) }}"
                            min="0"
                            step="1"
                            required
                        >

                        @error('jumlah_koli')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="form-help">
                            Masukkan jumlah koli secara manual.
                        </small>

                    </div>


                    {{-- =================================================
                         PCS PER KOLI
                    ================================================== --}}

                    <div class="col-md-6">

                        <label
                            for="pcs_per_koli"
                            class="form-label"
                        >
                            PCS per Koli
                            <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="pcs_per_koli"
                            name="pcs_per_koli"
                            class="form-control custom-input @error('pcs_per_koli') is-invalid @enderror"
                            placeholder="Contoh: 2"
                            value="{{ old('pcs_per_koli') }}"
                            min="1"
                            step="1"
                            required
                        >

                        @error('pcs_per_koli')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="form-help">
                            Masukkan jumlah PCS dalam setiap koli.
                        </small>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="form-footer">

                <a
                    href="{{ route('barangs.index') }}"
                    class="cancel-button"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="save-button"
                >
                    Simpan Barang
                </button>

            </div>

        </div>

    </form>

</div>


<style>

/* =========================================================
   PAGE
========================================================= */

.create-page {
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
        0 2px 7px rgba(180, 145, 0, .06);
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
   BACK BUTTON
========================================================= */

.back-button {
    min-height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 6px;

    padding: 0 15px;

    color: #64748b;

    background: #ffffff;

    border: 1px solid #dfe4ea;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    transition: all .18s ease;
}

.back-button:hover {
    color: #8a6d00;

    background: #fffbea;

    border-color: #ead98c;

    transform: translateY(-1px);
}


/* =========================================================
   ERROR
========================================================= */

.custom-alert {
    margin-bottom: 16px;

    padding: 12px 14px;

    border: 1px solid #efd9dc;

    border-radius: 9px;

    background: #fff7f7;

    color: #8f3d47;

    font-size: 13px;
}

.alert-content {
    display: flex;
    align-items: flex-start;
}

.alert-icon {
    width: 32px;
    height: 32px;

    flex: 0 0 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 10px;

    border-radius: 50%;

    background: #fbe7e9;

    color: #a33a45;

    font-weight: 700;
}

.custom-alert strong {
    color: #8f3d47;
}

.custom-alert ul {
    padding-left: 18px;
}


/* =========================================================
   FORM CARD
========================================================= */

.form-card {
    overflow: hidden;

    background: #ffffff;

    border: 1px solid #e6e8eb;

    border-radius: 10px;

    box-shadow:
        0 3px 10px rgba(15, 23, 42, .035);
}


/* =========================================================
   FORM HEADER
========================================================= */

.form-header {
    padding: 17px 20px;

    background: #ffffff;

    border-bottom: 1px solid #eceef0;
}

.form-header h5 {
    margin: 0 0 3px;

    color: #1e293b;

    font-size: 16px;
    font-weight: 700;
}

.form-header p {
    margin: 0;

    color: #94a3b8;

    font-size: 12px;
}


/* =========================================================
   FORM BODY
========================================================= */

.form-body {
    padding: 24px 20px;
}


/* =========================================================
   LABEL
========================================================= */

.form-label {
    display: block;

    margin-bottom: 7px;

    color: #475569;

    font-size: 13px;
    font-weight: 600;
}

.required {
    color: #c94b57;
}


/* =========================================================
   INPUT
========================================================= */

.custom-input {
    height: 42px;

    padding: 0 12px;

    color: #334155;

    background: #ffffff;

    border: 1px solid #dfe4ea;

    border-radius: 7px;

    font-size: 13px;

    box-shadow: none;

    transition:
        border-color .15s ease,
        box-shadow .15s ease;
}

.custom-input::placeholder {
    color: #a5adb6;
}

.custom-input:hover {
    border-color: #cbd2d9;
}

.custom-input:focus {
    color: #334155;

    background: #ffffff;

    border-color: #d8bd50;

    box-shadow:
        0 0 0 3px rgba(196, 154, 0, .09);
}

.custom-input.is-invalid {
    border-color: #dc6b76;
}

.custom-input.is-invalid:focus {
    border-color: #dc6b76;

    box-shadow:
        0 0 0 3px rgba(220, 107, 118, .08);
}


/* =========================================================
   HELP TEXT
========================================================= */

.form-help {
    display: block;

    margin-top: 5px;

    color: #a1a9b3;

    font-size: 11px;
}


/* =========================================================
   FOOTER
========================================================= */

.form-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 8px;

    padding: 14px 20px;

    background: #fafafa;

    border-top: 1px solid #eceef0;
}


/* =========================================================
   CANCEL
========================================================= */

.cancel-button {
    height: 38px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 0 15px;

    color: #64748b;

    background: #ffffff;

    border: 1px solid #dfe4ea;

    border-radius: 7px;

    font-size: 12px;
    font-weight: 600;

    text-decoration: none;

    transition: all .18s ease;
}

.cancel-button:hover {
    color: #475569;

    background: #f5f6f7;

    border-color: #d1d6db;
}


/* =========================================================
   SAVE
========================================================= */

.save-button {
    height: 38px;

    padding: 0 18px;

    color: #ffffff;

    background: #c49a00;

    border: 1px solid #c49a00;

    border-radius: 7px;

    font-size: 12px;
    font-weight: 600;

    box-shadow:
        0 3px 8px rgba(196, 154, 0, .13);

    transition: all .18s ease;
}

.save-button:hover {
    color: #ffffff;

    background: #ad8700;

    border-color: #ad8700;

    transform: translateY(-1px);
}

.save-button:active {
    transform: translateY(0);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .create-page {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    .page-header {
        align-items: flex-start;
    }

    .page-title {
        font-size: 20px;
    }

    .page-subtitle {
        font-size: 12px;
    }

    .back-button {
        min-height: 38px;

        padding: 0 12px;
    }

    .form-body {
        padding: 20px 15px;
    }

    .form-header {
        padding: 15px;
    }

    .form-footer {
        padding: 12px 15px;
    }

}


@media (max-width: 576px) {

    .page-header {
        flex-direction: column;

        width: 100%;
    }

    .page-heading {
        width: 100%;
    }

    .back-button {
        width: 100%;
    }

    .form-footer {
        display: grid;

        grid-template-columns: 1fr 1fr;
    }

    .cancel-button,
    .save-button {
        width: 100%;
    }

}

</style>

@endsection