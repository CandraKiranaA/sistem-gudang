@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Tambah Barang Masuk
            </h3>

            <p class="text-muted mb-0">
                Input data barang yang masuk ke gudang.
            </p>

        </div>


        <a
            href="{{ route('barang-masuk.index') }}"
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


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('barang-masuk.store') }}"
        method="POST"
    >

        @csrf


        {{-- ================================================= --}}
        {{-- INFORMASI BARANG --}}
        {{-- ================================================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-bold">
                    📦 Informasi Barang
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- TANGGAL --}}
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
                                    data-pcs="{{ $barang->pcs_per_koli }}"
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

                            <small class="text-danger">

                                Belum ada master barang.
                                Silakan tambahkan barang terlebih dahulu
                                melalui menu Data Barang.

                            </small>

                        @else

                            <small class="text-muted">

                                Data barang diambil otomatis dari
                                Master Barang.

                            </small>

                        @endif

                    </div>


                    {{-- PCS PER KOLI --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            PCS / Koli
                        </label>

                        <input
                            type="number"
                            id="pcs_per_koli"
                            class="form-control bg-light"
                            value="0"
                            readonly
                        >

                        <small class="text-muted">
                            Diambil dari Master Barang.
                        </small>

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-md-4">

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

                    </div>


                    {{-- JUMLAH KOLI --}}
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
                            value="{{ old('jumlah_koli', 1) }}"
                            required
                        >

                    </div>


                    {{-- JUMLAH PCS --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Jumlah PCS
                        </label>

                        <input
                            type="number"
                            id="jumlah_pcs"
                            class="form-control bg-light fw-bold"
                            value="0"
                            readonly
                        >

                        <small class="text-muted">

                            PCS dihitung otomatis berdasarkan
                            PCS / Koli.

                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- INFORMASI HARGA --}}
        {{-- ================================================= --}}

        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-bold">
                    💰 Informasi Harga
                </h5>

            </div>


            <div class="card-body">

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

        <div class="d-flex justify-content-end gap-2">

            <a
                href="{{ route('barang-masuk.index') }}"
                class="btn btn-secondary px-4"
            >
                Batal
            </a>


            <button
                type="submit"
                class="btn btn-primary px-4"
                {{ $barangs->isEmpty() ? 'disabled' : '' }}
            >

                💾 Simpan Barang Masuk

            </button>

        </div>


    </form>

</div>


{{-- ================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const barangSelect =
        document.getElementById('barang_id');

    const pcsPerKoli =
        document.getElementById('pcs_per_koli');

    const satuan =
        document.getElementById('satuan');

    const jumlahKoli =
        document.getElementById('jumlah_koli');

    const jumlahPcs =
        document.getElementById('jumlah_pcs');


    /*
     * Update informasi barang
     */
    function updateBarang() {

        const selected =
            barangSelect.options[
                barangSelect.selectedIndex
            ];


        if (!selected || !selected.value) {

            pcsPerKoli.value = 0;
            satuan.value = '';
            jumlahPcs.value = 0;

            return;
        }


        const pcs =
            parseInt(
                selected.dataset.pcs
            ) || 0;


        const satuanBarang =
            selected.dataset.satuan || '';


        pcsPerKoli.value = pcs;

        satuan.value = satuanBarang;


        hitungPcs();

    }


    /*
     * Hitung jumlah PCS
     *
     * Contoh:
     *
     * Kipas = 2 PCS/Koli
     *
     * 1 Koli = 2 PCS
     * 2 Koli = 4 PCS
     * 5 Koli = 10 PCS
     */
    function hitungPcs() {

        const koli =
            parseInt(
                jumlahKoli.value
            ) || 0;


        const pcs =
            parseInt(
                pcsPerKoli.value
            ) || 0;


        jumlahPcs.value =
            koli * pcs;

    }


    /*
     * Ketika barang diganti
     */
    barangSelect.addEventListener(
        'change',
        updateBarang
    );


    /*
     * Ketika jumlah koli diganti
     */
    jumlahKoli.addEventListener(
        'input',
        hitungPcs
    );


    /*
     * Jalankan ketika halaman pertama kali dibuka
     */
    updateBarang();

});

</script>

@endsection