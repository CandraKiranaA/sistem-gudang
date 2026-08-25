@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1">
                Edit Barang
            </h3>

            <p class="text-muted mb-0">
                Perbarui data barang yang tersedia di master barang.
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

        <div class="alert alert-success alert-dismissible fade show">

            <strong>
                Berhasil!
            </strong>

            <div>
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
    {{-- FORM EDIT --}}
    {{-- ===================================================== --}}

    <form
        action="{{ route('barangs.update', $barang) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        <div class="card shadow-sm">

            {{-- ================================================= --}}
            {{-- HEADER CARD --}}
            {{-- ================================================= --}}

            <div class="card-header bg-white">

                <h5 class="mb-1">
                    Informasi Barang
                </h5>

                <small class="text-muted">
                    Ubah informasi barang sesuai dengan data terbaru.
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
                            value="{{ old('nama_barang', $barang->nama_barang) }}"
                            maxlength="255"
                            required
                        >

                        @error('nama_barang')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <small class="text-muted">
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

                        <small class="text-muted">
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
                            value="{{ old('jumlah_koli', $barang->jumlah_koli ?? 1) }}"
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

                            <strong>
                                Edit Data Barang
                            </strong>

                            <div class="small mt-1">
                                Silakan periksa kembali nama barang,
                                satuan, jumlah koli, dan PCS per koli
                                sebelum menyimpan perubahan.
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
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection