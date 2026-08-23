@extends('layouts.app')

@section('content')

<div class="container-fluid px-2 px-md-3">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Barang Masuk
            </h3>

            <p class="text-muted mb-0">
                Kelola data barang yang masuk ke gudang.
            </p>
        </div>

        <a
            href="{{ route('barang-masuk.create') }}"
            class="btn btn-primary mt-2 mt-md-0"
        >
            + Tambah Barang Masuk
        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- PESAN SUKSES --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <strong>Berhasil!</strong>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ERROR --}}
    {{-- ========================================================= --}}

    @if($errors->any())

        <div class="alert alert-danger shadow-sm">

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


    {{-- ========================================================= --}}
    {{-- FILTER --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white border-bottom">

            <div class="d-flex align-items-center">

                <span
                    class="me-2"
                    style="font-size: 20px;"
                >
                    🔎
                </span>

                <div>

                    <h6 class="fw-bold mb-0">
                        Pencarian Data
                    </h6>

                    <small class="text-muted">
                        Cari barang berdasarkan nama atau tanggal.
                    </small>

                </div>

            </div>

        </div>


        <div class="card-body">

            <form
                method="GET"
                action="{{ route('barang-masuk.index') }}"
            >

                <div class="row g-3 align-items-end">


                    {{-- CARI BARANG --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Nama Barang
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Contoh: Kipas"
                            value="{{ request('search') }}"
                        >

                    </div>


                    {{-- TANGGAL MULAI --}}
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="tanggal_mulai"
                            class="form-control"
                            value="{{ request('tanggal_mulai') }}"
                        >

                    </div>


                    {{-- TANGGAL SELESAI --}}
                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Tanggal Selesai
                        </label>

                        <input
                            type="date"
                            name="tanggal_selesai"
                            class="form-control"
                            value="{{ request('tanggal_selesai') }}"
                        >

                    </div>


                    {{-- BUTTON --}}
                    <div class="col-md-2">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-secondary flex-fill"
                            >
                                Filter
                            </button>

                            <a
                                href="{{ route('barang-masuk.index') }}"
                                class="btn btn-light border"
                            >
                                Reset
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- DATA BARANG MASUK --}}
    {{-- ========================================================= --}}

    <div class="card shadow-sm border-0">


        {{-- HEADER CARD --}}

        <div class="card-header bg-white border-bottom">

            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">
                        Data Barang Masuk
                    </h5>

                    <small class="text-muted">
                        Riwayat barang yang masuk ke gudang.
                    </small>

                </div>


                <div class="mt-2 mt-md-0">

                    <span class="badge bg-primary rounded-pill px-3 py-2">

                        {{ $barangMasuks->total() }}

                        Data

                    </span>

                </div>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- TABLE --}}
        {{-- ===================================================== --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                    style="min-width: 1200px;"
                >

                    {{-- TABLE HEADER --}}

                    <thead class="table-light">

                        <tr>

                            <th
                                class="text-center"
                                style="width: 60px;"
                            >
                                No
                            </th>

                            <th
                                style="width: 120px;"
                            >
                                Tanggal
                            </th>

                            <th
                                style="min-width: 180px;"
                            >
                                Nama Barang
                            </th>

                            <th
                                class="text-center"
                                style="width: 100px;"
                            >
                                PCS / Koli
                            </th>

                            <th
                                class="text-center"
                                style="width: 90px;"
                            >
                                Koli
                            </th>

                            <th
                                class="text-center"
                                style="width: 90px;"
                            >
                                PCS
                            </th>

                            <th
                                class="text-end"
                                style="width: 160px;"
                            >
                                Harga Beli / Koli
                            </th>

                            <th
                                class="text-end"
                                style="width: 160px;"
                            >
                                Harga Jual / Koli
                            </th>

                            <th
                                class="text-end"
                                style="width: 160px;"
                            >
                                Harga Jual / PCS
                            </th>

                            <th
                                class="text-center"
                                style="width: 190px;"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}

                    <tbody>

                        @forelse($barangMasuks as $item)

                            <tr>


                                {{-- NO --}}

                                <td class="text-center text-muted">

                                    {{ $barangMasuks->firstItem() + $loop->index }}

                                </td>


                                {{-- TANGGAL --}}

                                <td>

                                    @if($item->tanggal_input)

                                        <span class="fw-semibold">

                                            {{ \Carbon\Carbon::parse(
                                                $item->tanggal_input
                                            )->format('d/m/Y') }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- NAMA BARANG --}}

                                <td>

                                    @if($item->barang)

                                        <div class="fw-semibold">

                                            {{ $item->barang->nama_barang }}

                                        </div>

                                        <small class="text-muted">

                                            {{ strtoupper(
                                                $item->barang->satuan ?? ''
                                            ) }}

                                        </small>

                                    @else

                                        <span class="text-danger">
                                            Barang tidak ditemukan
                                        </span>

                                    @endif

                                </td>


                                {{-- PCS PER KOLI --}}

                                <td class="text-center">

                                    <span class="badge bg-light text-dark border px-3">

                                        {{ number_format(
                                            $item->barang->pcs_per_koli ?? 0
                                        ) }}

                                        PCS

                                    </span>

                                </td>


                                {{-- KOLI --}}

                                <td class="text-center">

                                    <span class="fw-semibold">

                                        {{ number_format(
                                            $item->jumlah_koli ?? 0
                                        ) }}

                                    </span>

                                </td>


                                {{-- PCS --}}

                                <td class="text-center">

                                    <span class="badge bg-primary-subtle text-primary px-3">

                                        {{ number_format(
                                            $item->jumlah_pcs ?? 0
                                        ) }}

                                    </span>

                                </td>


                                {{-- HARGA BELI --}}

                                <td class="text-end">

                                    <div class="fw-semibold">

                                        Rp
                                        {{ number_format(
                                            $item->harga_beli_koli ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </td>


                                {{-- HARGA JUAL KOLI --}}

                                <td class="text-end">

                                    <div class="fw-semibold">

                                        Rp
                                        {{ number_format(
                                            $item->harga_jual_koli ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </td>


                                {{-- HARGA JUAL PCS --}}

                                <td class="text-end">

                                    <div class="fw-semibold">

                                        Rp
                                        {{ number_format(
                                            $item->harga_jual_pcs ?? 0,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="d-flex justify-content-center gap-1">


                                        {{-- DETAIL --}}

                                        <a
                                            href="{{ route(
                                                'barang-masuk.show',
                                                $item
                                            ) }}"
                                            class="btn btn-sm btn-info text-white"
                                            title="Lihat detail"
                                        >
                                            Detail
                                        </a>


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'barang-masuk.edit',
                                                $item
                                            ) }}"
                                            class="btn btn-sm btn-warning"
                                            title="Edit data"
                                        >
                                            Edit
                                        </a>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route(
                                                'barang-masuk.destroy',
                                                $item
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Apakah kamu yakin ingin menghapus data ini?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus data"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty


                            {{-- DATA KOSONG --}}

                            <tr>

                                <td
                                    colspan="10"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <div
                                            style="font-size: 50px;"
                                            class="mb-3"
                                        >
                                            📦
                                        </div>

                                        <h6 class="fw-bold">
                                            Belum ada data barang masuk
                                        </h6>

                                        <p class="mb-3">
                                            Silakan tambahkan barang masuk terlebih dahulu.
                                        </p>

                                        <a
                                            href="{{ route(
                                                'barang-masuk.create'
                                            ) }}"
                                            class="btn btn-primary"
                                        >
                                            + Tambah Barang Masuk
                                        </a>

                                    </div>

                                </td>

                            </tr>


                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- PAGINATION --}}
        {{-- ===================================================== --}}

        @if($barangMasuks->hasPages())

            <div class="card-footer bg-white">

                <div class="d-flex flex-wrap justify-content-between align-items-center">

                    <small class="text-muted mb-2 mb-md-0">

                        Menampilkan

                        <strong>
                            {{ $barangMasuks->firstItem() }}
                        </strong>

                        -

                        <strong>
                            {{ $barangMasuks->lastItem() }}
                        </strong>

                        dari

                        <strong>
                            {{ $barangMasuks->total() }}
                        </strong>

                        data

                    </small>


                    <div>

                        {{ $barangMasuks->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- TAMBAHAN STYLE --}}
{{-- ========================================================= --}}

<style>

    /* Card */

    .card {
        border-radius: 12px;
    }


    /* Table */

    .table {
        font-size: 14px;
    }


    .table thead th {

        font-size: 13px;
        font-weight: 600;
        color: #495057;
        white-space: nowrap;

        padding-top: 14px;
        padding-bottom: 14px;

        vertical-align: middle;

    }


    .table tbody td {

        padding: 13px 12px;

        vertical-align: middle;

    }


    .table tbody tr {

        border-bottom: 1px solid #eeeeee;

    }


    .table tbody tr:last-child {

        border-bottom: none;

    }


    /* Button */

    .btn-sm {

        padding: 5px 10px;

        font-size: 12px;

        border-radius: 6px;

    }


    /* Badge */

    .badge {

        font-weight: 500;

    }


    /* Pagination */

    .pagination {

        margin-bottom: 0;

    }


    /* Mobile */

    @media (max-width: 768px) {

        .content {
            padding: 15px;
        }

    }

</style>

@endsection