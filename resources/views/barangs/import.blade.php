@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Import Data Barang
            </h3>

            <p class="text-muted mb-0">
                Tambahkan banyak data barang ke Master Barang menggunakan file Excel.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('barangs.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>

            <a
                href="{{ route('barangs.create') }}"
                class="btn btn-primary"
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
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <strong>
                Import berhasil!
            </strong>

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
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <strong>
                Import gagal!
            </strong>

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

        <div class="alert alert-danger">

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

    <div class="card shadow-sm border-0">

        {{-- ================================================= --}}
        {{-- CARD HEADER --}}
        {{-- ================================================= --}}

        <div class="card-header bg-white py-3">

            <div class="d-flex align-items-center">

                <div
                    class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3"
                    style="width: 48px; height: 48px;"
                >

                    <span style="font-size: 24px;">
                        📥
                    </span>

                </div>

                <div>

                    <h5 class="mb-1">
                        Upload File Excel
                    </h5>

                    <small class="text-muted">
                        Pilih file Excel untuk memasukkan data barang secara massal.
                    </small>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BODY --}}
        {{-- ================================================= --}}

        <div class="card-body p-4">

            <form
                action="{{ route('barangs.import') }}"
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

                    <div
                        class="border rounded-3 p-4 text-center bg-light"
                    >

                        <div
                            style="font-size: 48px;"
                            class="mb-3"
                        >
                            📊
                        </div>

                        <h6 class="fw-semibold mb-2">
                            Pilih file Excel
                        </h6>

                        <p class="text-muted small mb-3">
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

                            <small class="text-muted">
                                Ukuran maksimal:
                                <strong>100 MB</strong>
                            </small>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- CONTOH FORMAT EXCEL --}}
                {{-- ================================================= --}}

                <div class="alert alert-info border-0">

                    <div class="d-flex">

                        <div
                            class="me-3"
                            style="font-size: 24px;"
                        >
                            📋
                        </div>

                        <div class="w-100">

                            <h6 class="fw-bold mb-2">
                                Contoh Format Data Excel
                            </h6>

                            <p class="small mb-3">
                                Berikut contoh format data yang dapat digunakan
                                untuk import barang.
                            </p>

                            <div class="table-responsive">

                                <table
                                    class="table table-sm table-bordered bg-white mb-0"
                                >

                                    <thead class="table-light">

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

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('barangs.index') }}"
                        class="btn btn-secondary px-4"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success px-4"
                    >
                        📥 Import Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection