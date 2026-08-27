```blade
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


{{-- ============================= --}}
{{-- INFORMASI CUSTOMER --}}
{{-- ============================= --}}

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



{{-- ============================= --}}
{{-- BARANG YANG DIBELI --}}
{{-- ============================= --}}

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


            {{-- BARIS BARANG --}}

            <div class="barang-row row g-2 mb-3">


                {{-- BARANG --}}

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


                {{-- KOLI --}}

                <div class="col-md-2">

                    <label class="form-label">
                        Koli
                    </label>

                    <input
                        type="number"
                        name="jumlah_koli[]"
                        class="form-control jumlah-koli"
                        value="0"
                        min="0"
                    >

                </div>


                {{-- PCS --}}

                <div class="col-md-2">

                    <label class="form-label">
                        PCS
                    </label>

                    <input
                        type="number"
                        name="jumlah_pcs[]"
                        class="form-control jumlah-pcs"
                        value="0"
                        min="0"
                    >

                </div>


                {{-- HARGA --}}

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


                {{-- HAPUS --}}

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



        {{-- ============================= --}}
        {{-- RINGKASAN PEMBAYARAN --}}
        {{-- ============================= --}}

        <div class="border-top pt-4 mt-4">

            <div class="row justify-content-end">

                <div class="col-md-5">


                    {{-- SUBTOTAL --}}

                    <div class="d-flex justify-content-between mb-3">

                        <span>
                            Subtotal
                        </span>

                        <strong id="subtotal-display">
                            Rp 0
                        </strong>

                    </div>


                    {{-- DISKON --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Diskon
                        </label>

                        <div class="input-group">

                            <input
                                type="number"
                                name="diskon"
                                id="diskon"
                                class="form-control"
                                value="{{ old('diskon', 0) }}"
                                min="0"
                                max="100"
                                step="0.01"
                                oninput="hitungTotal()"
                            >

                            <span class="input-group-text">
                                %
                            </span>

                        </div>

                        <small class="text-muted">
                            Masukkan diskon antara 0% sampai 100%.
                        </small>

                    </div>


                    {{-- NILAI DISKON --}}

                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Potongan Diskon
                        </span>

                        <span
                            class="text-danger"
                            id="diskon-display"
                        >
                            - Rp 0
                        </span>

                    </div>


                    {{-- TOTAL --}}

                    <div class="d-flex justify-content-between border-top pt-3">

                        <span class="fw-bold">
                            TOTAL
                        </span>

                        <strong
                            class="text-primary fs-5"
                            id="total-display"
                        >
                            Rp 0
                        </strong>

                    </div>


                </div>

            </div>

        </div>



        {{-- ============================= --}}
        {{-- BUTTON SIMPAN --}}
        {{-- ============================= --}}

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


/*
|--------------------------------------------------------------------------
| FORMAT RUPIAH
|--------------------------------------------------------------------------
*/

function formatRupiah(angka)
{
    return 'Rp ' +
        Number(angka).toLocaleString('id-ID');
}



/*
|--------------------------------------------------------------------------
| HITUNG TOTAL
|--------------------------------------------------------------------------
*/

function hitungTotal()
{

    let subtotal = 0;


    /*
    |--------------------------------------------------------------------------
    | HITUNG SEMUA BARANG
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.barang-row').forEach(row => {


        const select =
            row.querySelector('.barang-select');


        const option =
            select.options[select.selectedIndex];


        const harga =
            Number(option?.dataset.harga || 0);


        const koli =
            Number(
                row.querySelector('.jumlah-koli').value || 0
            );


        const pcs =
            Number(
                row.querySelector('.jumlah-pcs').value || 0
            );


        const pcsPerKoli =
            Number(option?.dataset.koli || 1);


        /*
        |--------------------------------------------------------------------------
        | TOTAL PCS
        |--------------------------------------------------------------------------
        */

        const totalPcs =
            (koli * pcsPerKoli) + pcs;


        /*
        |--------------------------------------------------------------------------
        | SUBTOTAL
        |--------------------------------------------------------------------------
        */

        subtotal +=
            totalPcs * harga;

    });



    /*
    |--------------------------------------------------------------------------
    | AMBIL DISKON %
    |--------------------------------------------------------------------------
    */

    let diskon =
        Number(
            document.getElementById('diskon').value || 0
        );


    /*
    |--------------------------------------------------------------------------
    | BATASI 0 - 100%
    |--------------------------------------------------------------------------
    */

    if (diskon < 0) {

        diskon = 0;

    }


    if (diskon > 100) {

        diskon = 100;

    }



    /*
    |--------------------------------------------------------------------------
    | HITUNG NILAI POTONGAN
    |--------------------------------------------------------------------------
    */

    const jumlahDiskon =
        subtotal * (diskon / 100);



    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL AKHIR
    |--------------------------------------------------------------------------
    */

    const total =
        subtotal - jumlahDiskon;



    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN SUBTOTAL
    |--------------------------------------------------------------------------
    */

    document.getElementById('subtotal-display')
        .textContent =
        formatRupiah(subtotal);



    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN POTONGAN DISKON
    |--------------------------------------------------------------------------
    */

    document.getElementById('diskon-display')
        .textContent =
        '- ' + formatRupiah(jumlahDiskon);



    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN TOTAL
    |--------------------------------------------------------------------------
    */

    document.getElementById('total-display')
        .textContent =
        formatRupiah(total);

}



/*
|--------------------------------------------------------------------------
| TAMBAH BARANG
|--------------------------------------------------------------------------
*/

function tambahBarang()
{

    const container =
        document.getElementById('barang-container');


    const firstRow =
        document.querySelector('.barang-row');


    const newRow =
        firstRow.cloneNode(true);



    /*
    |--------------------------------------------------------------------------
    | RESET INPUT
    |--------------------------------------------------------------------------
    */

    newRow
        .querySelectorAll('input')
        .forEach(input => {


            if (
                input.name === 'jumlah_koli[]' ||
                input.name === 'jumlah_pcs[]'
            ) {

                input.value = 0;

            }


            if (
                input.classList.contains('harga-display')
            ) {

                input.value = 'Rp 0';

            }

        });



    /*
    |--------------------------------------------------------------------------
    | RESET SELECT
    |--------------------------------------------------------------------------
    */

    newRow
        .querySelector('select')
        .value = '';



    container.appendChild(newRow);


    hitungTotal();

}



/*
|--------------------------------------------------------------------------
| HAPUS BARANG
|--------------------------------------------------------------------------
*/

function hapusBarang(button)
{

    const rows =
        document.querySelectorAll('.barang-row');


    if (rows.length <= 1) {

        alert(
            'Minimal harus ada satu barang.'
        );

        return;

    }


    button
        .closest('.barang-row')
        .remove();


    hitungTotal();

}



/*
|--------------------------------------------------------------------------
| PILIH BARANG
|--------------------------------------------------------------------------
*/

document.addEventListener('change', function(event)
{

    if (
        event.target.classList.contains('barang-select')
    ) {


        const select =
            event.target;


        const option =
            select.options[
                select.selectedIndex
            ];


        const harga =
            option?.dataset.harga || 0;


        const row =
            select.closest('.barang-row');


        const display =
            row.querySelector('.harga-display');



        display.value =
            formatRupiah(harga);



        hitungTotal();

    }

});



/*
|--------------------------------------------------------------------------
| JUMLAH BARANG BERUBAH
|--------------------------------------------------------------------------
*/

document.addEventListener('input', function(event)
{

    if (
        event.target.classList.contains('jumlah-koli') ||
        event.target.classList.contains('jumlah-pcs')
    ) {

        hitungTotal();

    }

});



/*
|--------------------------------------------------------------------------
| SAAT HALAMAN SELESAI DIMUAT
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function()
{

    hitungTotal();

});


</script>

@endsection
