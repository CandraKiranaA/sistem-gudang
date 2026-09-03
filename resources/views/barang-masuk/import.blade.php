@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Import Barang Masuk
            </h3>

            <p class="text-muted mb-0">
                Tambahkan banyak data barang masuk ke gudang menggunakan file Excel.
            </p>

        </div>


        <div class="d-flex gap-2">

            {{-- KEMBALI --}}
            <a
                href="{{ route('barang-masuk.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>


            {{-- TAMBAH MANUAL --}}
            <a
                href="{{ route('barang-masuk.create') }}"
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
            class="alert alert-danger alert-dismissible fade show"
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

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

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
        {{-- HEADER CARD --}}
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
                        Pilih file Excel untuk memasukkan data barang masuk secara massal.
                    </small>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BODY --}}
        {{-- ================================================= --}}

        <div class="card-body p-4">

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
                                Format Kolom Excel
                            </h6>


                            <p class="small mb-3">

                                Pastikan baris pertama pada file Excel
                                menggunakan nama kolom berikut:

                            </p>


                            <div class="table-responsive">

                                <table class="table table-sm table-bordered bg-white mb-0">

                                    <thead class="table-light">

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

                                <small class="text-muted">

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

                <div class="alert alert-warning border-0">

                    <div class="d-flex">

                        <div
                            class="me-3"
                            style="font-size: 24px;"
                        >
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

                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('barang-masuk.index') }}"
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
