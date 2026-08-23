@extends('layouts.app')

@section('content')

<div class="container">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="mb-1">
                Master Barang
            </h3>

            <p class="text-muted mb-0">
                Kelola data barang yang tersedia di gudang.
            </p>

        </div>


        {{-- BUTTON TAMBAH BARANG --}}
        <a
            href="{{ route('barangs.create') }}"
            class="btn btn-primary"
        >
            + Tambahkan Barang
        </a>

    </div>


    {{-- ===================================================== --}}
    {{-- PESAN SUKSES --}}
    {{-- ===================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            {{ session('success') }}

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

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- ===================================================== --}}
    {{-- CARD DATA BARANG --}}
    {{-- ===================================================== --}}

    <div class="card shadow-sm">

        {{-- HEADER CARD --}}
        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">
                        Daftar Barang
                    </h5>

                    <small class="text-muted">
                        Data master barang gudang
                    </small>

                </div>


                {{-- JUMLAH BARANG --}}
                <span class="badge bg-primary">
                    {{ $barangs->total() }} Barang
                </span>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- TABLE --}}
        {{-- ================================================= --}}

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            {{-- NO --}}
                            <th
                                class="px-3"
                                style="width: 70px;"
                            >
                                No
                            </th>


                            {{-- NAMA BARANG --}}
                            <th>
                                Nama Barang
                            </th>


                            {{-- KOLI --}}
                            <th
                                class="text-center"
                                style="width: 120px;"
                            >
                                Koli
                            </th>


                            {{-- PCS --}}
                            <th
                                class="text-center"
                                style="width: 120px;"
                            >
                                PCS
                            </th>


                            {{-- SATUAN --}}
                            <th>
                                Satuan
                            </th>


                            {{-- AKSI --}}
                            <th
                                class="text-center"
                                style="width: 180px;"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($barangs as $barang)

                            <tr>

                                {{-- NO --}}
                                <td class="px-3">

                                    {{ $barangs->firstItem() + $loop->index }}

                                </td>


                                {{-- NAMA BARANG --}}
                                <td>

                                    <span class="fw-semibold">
                                        {{ $barang->nama_barang }}
                                    </span>

                                </td>


                                {{-- KOLI --}}
                                <td class="text-center">

                                    <span class="badge bg-primary">

                                        {{ $barang->jumlah_koli ?? 1 }}

                                    </span>

                                </td>


                                {{-- PCS --}}
                                <td class="text-center">

                                    <span class="badge bg-success">

                                        {{ number_format(
                                            $barang->pcs_per_koli ?? 0
                                        ) }}

                                    </span>

                                </td>


                                {{-- SATUAN --}}
                                <td>

                                    {{ strtoupper(
                                        $barang->satuan ?? '-'
                                    ) }}

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div
                                        class="d-flex justify-content-center gap-2"
                                    >

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route(
                                                'barangs.edit',
                                                $barang
                                            ) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            Edit
                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route(
                                                'barangs.destroy',
                                                $barang
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Apakah kamu yakin ingin menghapus barang ini?'
                                            )"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- DATA KOSONG --}}
                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <div
                                            style="font-size: 40px;"
                                            class="mb-3"
                                        >
                                            📦
                                        </div>

                                        <h6>
                                            Belum ada master barang
                                        </h6>

                                        <p class="mb-3">
                                            Silakan tambahkan barang terlebih dahulu.
                                        </p>


                                        {{-- BUTTON TAMBAH SAAT DATA KOSONG --}}
                                        <a
                                            href="{{ route('barangs.create') }}"
                                            class="btn btn-primary"
                                        >
                                            + Tambahkan Barang
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($barangs->hasPages())

            <div class="card-footer bg-white">

                <div
                    class="d-flex justify-content-between align-items-center"
                >

                    <small class="text-muted">

                        Menampilkan
                        {{ $barangs->firstItem() }}
                        -
                        {{ $barangs->lastItem() }}
                        dari
                        {{ $barangs->total() }}
                        barang

                    </small>


                    <div>

                        {{ $barangs->links() }}

                    </div>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection