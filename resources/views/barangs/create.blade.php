@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HEADER --}}
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


    {{-- ERROR --}}
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


    {{-- FORM --}}
    <form
        action="{{ route('barangs.store') }}"
        method="POST"
    >

        @csrf

        <div class="card shadow-sm">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    Informasi Barang
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    {{-- NAMA BARANG --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Barang
                        </label>

                        <input
                            type="text"
                            name="nama_barang"
                            class="form-control"
                            placeholder="Contoh: Kipas"
                            value="{{ old('nama_barang') }}"
                            required
                        >

                        <small class="text-muted">
                            Masukkan nama barang.
                        </small>

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Satuan
                        </label>

                        <select
                            name="satuan"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Satuan --
                            </option>

                            <option
                                value="pcs"
                                {{ old('satuan') == 'pcs' ? 'selected' : '' }}
                            >
                                PCS
                            </option>

                            <option
                                value="unit"
                                {{ old('satuan') == 'unit' ? 'selected' : '' }}
                            >
                                Unit
                            </option>

                            <option
                                value="set"
                                {{ old('satuan') == 'set' ? 'selected' : '' }}
                            >
                                Set
                            </option>

                            <option
                                value="buah"
                                {{ old('satuan') == 'buah' ? 'selected' : '' }}
                            >
                                Buah
                            </option>

                            <option
                                value="lusin"
                                {{ old('satuan') == 'lusin' ? 'selected' : '' }}
                            >
                                Lusin
                            </option>

                            <option
                                value="box"
                                {{ old('satuan') == 'box' ? 'selected' : '' }}
                            >
                                Box
                            </option>

                            <option
                                value="karton"
                                {{ old('satuan') == 'karton' ? 'selected' : '' }}
                            >
                                Karton
                            </option>

                        </select>

                    </div>


                    {{-- KOLI --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jumlah Koli
                        </label>

                        <input
                            type="number"
                            name="jumlah_koli"
                            class="form-control"
                            value="{{ old('jumlah_koli', 1) }}"
                            min="1"
                            readonly
                        >

                        <small class="text-muted">
                            Jumlah koli otomatis 1.
                        </small>

                    </div>


                    {{-- PCS --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jumlah PCS
                        </label>

                        <input
                            type="number"
                            name="pcs_per_koli"
                            class="form-control"
                            placeholder="Contoh: 2"
                            value="{{ old('pcs_per_koli') }}"
                            min="1"
                            required
                        >

                        <small class="text-muted">
                            Jumlah PCS dapat diisi manual.
                        </small>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
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