@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">
                Tambah Barang
            </h3>

            <p class="text-muted mb-0">
                Tambahkan data barang baru ke master barang.
            </p>
        </div>

        <a
            href="{{ route('barangs.index') }}"
            class="btn btn-outline-secondary"
        >
            ← Kembali
        </a>

    </div>


    {{-- ===================================================== --}}
    {{-- PESAN ERROR --}}
    {{-- ===================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

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
    {{-- FORM --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('barangs.store') }}"
        method="POST"
    >

        @csrf

        <div class="card shadow-sm">

            {{-- ================================================= --}}
            {{-- HEADER CARD --}}
            {{-- ================================================= --}}

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    Informasi Barang
                </h5>

                <small class="text-muted">
                    Semua data dapat diinput secara manual.
                </small>

            </div>


            {{-- ================================================= --}}
            {{-- BODY --}}
            {{-- ================================================= --}}

            <div class="card-body">

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
                            value="{{ old('nama_barang') }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_barang')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="text-muted">
                            Masukkan nama barang yang akan disimpan.
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

                        {{-- Input manual satuan --}}
                        <input
                            type="text"
                            id="satuan"
                            name="satuan"
                            class="form-control @error('satuan') is-invalid @enderror"
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

                        <small class="text-muted">
                            Satuan dapat diisi secara manual.
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
                            placeholder="Masukkan jumlah koli"
                            value="{{ old('jumlah_koli') }}"
                            min="1"
                            step="1"
                            required
                        >

                        @error('jumlah_koli')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="text-muted">
                            Masukkan jumlah koli secara manual.
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

                        <small class="text-muted">
                            Masukkan jumlah PCS dalam setiap koli.
                        </small>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- INFORMASI --}}
                {{-- ================================================= --}}

                <div class="alert alert-info mt-4 mb-0">

                    <div class="d-flex">

                        <div class="me-2">
                            ℹ️
                        </div>

                        <div>
                            <strong>Input Manual</strong>

                            <div class="small mt-1">
                                Nama barang, satuan, jumlah koli, dan PCS per koli
                                semuanya dapat diisi secara manual.
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('barangs.index') }}"
                        class="btn btn-light border"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Simpan Barang
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection