@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">Edit Barang Masuk</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('barang-masuk.update', $barangMasuk) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div class="card">

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
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

                    <div class="col-md-8">

                        <label class="form-label">
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

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            PCS / Koli
                        </label>

                        <input
                            type="number"
                            id="pcs_per_koli"
                            class="form-control"
                            value="{{ $barangMasuk->barang->pcs_per_koli }}"
                            readonly
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
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

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Jumlah PCS
                        </label>

                        <input
                            type="number"
                            id="jumlah_pcs"
                            class="form-control"
                            value="{{ $barangMasuk->jumlah_pcs }}"
                            readonly
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
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

                    <div class="col-md-4">

                        <label class="form-label">
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

                    <div class="col-md-4">

                        <label class="form-label">
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

            <div class="card-footer text-end">

                <a
                    href="{{ route('barang-masuk.index') }}"
                    class="btn btn-light"
                >
                    Batal
                </a>

                <button class="btn btn-primary">
                    Update
                </button>

            </div>

        </div>

    </form>

</div>

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

        pcsPerKoli.value = perKoli;

        pcs.value =
            jumlahKoli * perKoli;
    }


    barang.addEventListener('change', hitung);
    koli.addEventListener('input', hitung);

    hitung();

});

</script>

@endsection