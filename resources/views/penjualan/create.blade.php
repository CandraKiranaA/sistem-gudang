@extends('layouts.app')

@section('title', 'Buat Nota')

@section('content')

<div class="mb-4">

    <h3 class="fw-bold mb-1">
        🧾 Buat Nota
    </h3>

    <p class="text-muted mb-0">
        Masukkan data penjualan customer
    </p>

</div>


@if(session('error'))

    <div class="alert alert-danger">
        {{ session('error') }}
    </div>

@endif


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
    action="{{ route('penjualan.store') }}"
    method="POST"
>

@csrf


<div class="card shadow-sm mb-4">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Informasi Customer
        </h5>


        <div class="row">

            <div class="col-md-6">

                <label class="form-label">
                    Nama Customer
                </label>

                <input
                    type="text"
                    name="nama_customer"
                    class="form-control"
                    value="{{ old('nama_customer') }}"
                    placeholder="Contoh: Toko Jaya"
                    required
                >

            </div>


            <div class="col-md-6">

                <label class="form-label">
                    Tanggal Penjualan
                </label>

                <input
                    type="datetime-local"
                    name="tanggal_penjualan"
                    class="form-control"
                    value="{{ old('tanggal_penjualan', now()->format('Y-m-d\TH:i')) }}"
                    required
                >

            </div>

        </div>

    </div>

</div>



<div class="card shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="fw-bold mb-0">
                Barang yang Dibeli
            </h5>

            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                onclick="tambahBarang()"
            >
                + Tambah Barang
            </button>

        </div>


        <div id="barang-container">


            <div class="barang-row row g-2 mb-3">


                <div class="col-md-4">

                    <label class="form-label">
                        Barang
                    </label>

                    <select
                        name="barang_id[]"
                        class="form-select barang-select"
                        required
                    >

                        <option value="">
                            -- Pilih Barang --
                        </option>

                        @foreach($barangs as $barang)

    <option
        value="{{ $barang->id }}"
        data-harga="{{ $barang->barangMasuks->last()?->harga_jual_pcs ?? 0 }}"
        data-koli="{{ $barang->pcs_per_koli }}"
    >

        {{ $barang->nama_barang }}

    </option>

@endforeach

                    </select>

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Koli
                    </label>

                    <input
                        type="number"
                        name="jumlah_koli[]"
                        class="form-control"
                        value="0"
                        min="0"
                    >

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        PCS
                    </label>

                    <input
                        type="number"
                        name="jumlah_pcs[]"
                        class="form-control"
                        value="0"
                        min="0"
                    >

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Harga / PCS
                    </label>

                    <input
                        type="text"
                        class="form-control harga-display"
                        value="Rp 0"
                        readonly
                    >

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="button"
                        class="btn btn-outline-danger w-100"
                        onclick="hapusBarang(this)"
                    >
                        Hapus
                    </button>

                </div>


            </div>

        </div>


        <div class="d-flex justify-content-end mt-4">

            <button
                type="submit"
                class="btn btn-primary px-4"
            >
                💾 Simpan & Buat Nota
            </button>

        </div>

    </div>

</div>


</form>


<script>

function tambahBarang()
{
    const container =
        document.getElementById('barang-container');

    const firstRow =
        document.querySelector('.barang-row');

    const newRow =
        firstRow.cloneNode(true);


    newRow
        .querySelectorAll('input')
        .forEach(input => {

            if (input.name === 'jumlah_koli[]' ||
                input.name === 'jumlah_pcs[]') {

                input.value = 0;

            }

            if (input.classList.contains('harga-display')) {
                input.value = 'Rp 0';
            }

        });


    newRow
        .querySelector('select')
        .value = '';


    container.appendChild(newRow);
}


function hapusBarang(button)
{
    const rows =
        document.querySelectorAll('.barang-row');


    if (rows.length <= 1) {
        alert('Minimal harus ada satu barang.');
        return;
    }


    button
        .closest('.barang-row')
        .remove();
}


document.addEventListener('change', function(event)
{
    if (
        event.target.classList.contains('barang-select')
    ) {

        const select =
            event.target;

        const option =
            select.options[select.selectedIndex];

        const harga =
            option.dataset.harga || 0;

        const row =
            select.closest('.barang-row');

        const display =
            row.querySelector('.harga-display');


        display.value =
            'Rp ' +
            Number(harga).toLocaleString('id-ID');

    }
});

</script>

@endsection