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


{{-- =========================================================
     PESAN ERROR
========================================================= --}}

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
    id="form-penjualan"
>

@csrf


{{-- =========================================================
     INFORMASI CUSTOMER
========================================================= --}}

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <h5 class="fw-bold mb-3">
            Informasi Customer
        </h5>

        <div class="row g-3">

            {{-- NAMA CUSTOMER --}}

            <div class="col-md-6">

                <label class="form-label fw-semibold">
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


            {{-- TANGGAL --}}

            <div class="col-md-6">

                <label class="form-label fw-semibold">
                    Tanggal Penjualan
                </label>

                <input
                    type="datetime-local"
                    name="tanggal_penjualan"
                    class="form-control"
                    value="{{ old(
                        'tanggal_penjualan',
                        now()->format('Y-m-d\TH:i')
                    ) }}"
                    required
                >

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     BARANG YANG DIBELI
========================================================= --}}

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h5 class="fw-bold mb-1">
                    Barang yang Dibeli
                </h5>

                <small class="text-muted">
                    Masukkan jumlah koli atau PCS yang dijual
                </small>

            </div>

            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                onclick="tambahBarang()"
            >
                + Tambah Barang
            </button>

        </div>


        <div id="barang-container">

            {{-- =================================================
                 BARIS BARANG
            ================================================== --}}

            <div class="barang-row row g-2 mb-3 align-items-end">

                {{-- BARANG --}}

                <div class="col-lg-5 col-md-12">

                    <label class="form-label fw-semibold">
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
                                data-harga="{{ $barang->barangMasuks->sortByDesc('tanggal_input')->first()?->harga_jual_pcs ?? 0 }}"
                                data-koli="{{ $barang->pcs_per_koli }}"
                            >

                                {{ $barang->nama_barang }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- KOLI --}}

                <div class="col-lg-2 col-md-4">

                    <label class="form-label fw-semibold">
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

                <div class="col-lg-2 col-md-4">

                    <label class="form-label fw-semibold">
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


                {{-- HARGA PCS --}}

                <div class="col-lg-2 col-md-4">

                    <label class="form-label fw-semibold">
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

                <div class="col-lg-1 col-md-12">

                    <button
                        type="button"
                        class="btn btn-outline-danger w-100"
                        onclick="hapusBarang(this)"
                        title="Hapus barang"
                    >
                        Reset
                    </button>

                </div>

            </div>

        </div>


        {{-- KETERANGAN --}}

        <div class="alert alert-light border mt-3 mb-0">

            <small class="text-muted">

                <strong>Perhitungan:</strong>

                Total PCS =
                (Koli × PCS per Koli) + PCS tambahan.

            </small>

        </div>

    </div>

</div>



{{-- =========================================================
     RINGKASAN PEMBAYARAN
========================================================= --}}

<div class="card shadow-sm mb-4 payment-card">

    <div class="card-body p-4">

        {{-- HEADER --}}

        <div class="payment-header mb-4">

            <h5 class="fw-bold mb-1">
                💰 Ringkasan Pembayaran
            </h5>

            <small class="text-muted">
                Periksa total pembayaran sebelum menyimpan nota.
            </small>

        </div>


        {{-- =================================================
             PAYMENT SUMMARY
        ================================================== --}}

        <div class="payment-summary">


            {{-- =================================================
                 SUBTOTAL
            ================================================== --}}

            <div class="payment-row">

                <div class="payment-label">
                    Subtotal
                </div>

                <strong
                    id="subtotal-display"
                    class="payment-value"
                >
                    Rp 0
                </strong>

            </div>



            {{-- =================================================
                 DISKON
            ================================================== --}}

            <div class="payment-row">

                <div class="payment-label-box">

                    <label
                        for="diskon"
                        class="payment-label fw-semibold mb-1"
                    >
                        Diskon
                    </label>

                    <small class="text-muted d-block">
                        Masukkan diskon antara 0% sampai 100%.
                    </small>

                </div>


                <div class="diskon-input">

                    <input
                        type="number"
                        name="diskon"
                        id="diskon"
                        class="form-control text-end"
                        value="{{ old('diskon', 0) }}"
                        min="0"
                        max="100"
                        step="0.01"
                    >

                    <span class="diskon-percent">
                        %
                    </span>

                </div>

            </div>



            {{-- =================================================
                 POTONGAN DISKON
            ================================================== --}}

            <div class="payment-row">

                <div class="payment-label text-muted">
                    Potongan Diskon
                </div>

                <span
                    class="payment-value text-danger"
                    id="diskon-display"
                >
                    - Rp 0
                </span>

            </div>



            {{-- =================================================
                 TOTAL
            ================================================== --}}

            <div class="payment-total-box">

                <div>

                    <div class="payment-total-label">
                        TOTAL YANG HARUS DIBAYAR
                    </div>

                    <small class="text-muted">
                        Setelah potongan diskon
                    </small>

                </div>

                <strong
                    class="payment-total-value"
                    id="total-display"
                >
                    Rp 0
                </strong>

            </div>



            {{-- =================================================
                 PEMBAYARAN CUSTOMER
            ================================================== --}}

            <div class="payment-section">

                <div class="payment-section-title">
                    Pembayaran Customer
                </div>


                {{-- BAYAR CASH --}}

                <div class="payment-field">

                    <label
                        for="bayar_cash"
                        class="form-label fw-semibold"
                    >
                        Bayar Cash
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="bayar_cash"
                            id="bayar_cash"
                            class="form-control"
                            value="{{ old('bayar_cash', 0) }}"
                            min="0"
                            step="1"
                            placeholder="0"
                        >

                    </div>

                    <small class="text-muted">
                        Masukkan jumlah uang yang dibayarkan customer.
                    </small>

                </div>



                {{-- HUTANG --}}

                <div class="payment-field hutang-field">

                    <label
                        for="hutang"
                        class="form-label fw-semibold"
                    >
                        Hutang
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="hutang"
                            id="hutang"
                            class="form-control"
                            value="0"
                            readonly
                        >

                    </div>

                    <small
                        class="text-muted"
                        id="hutang-keterangan"
                    >
                        Tidak ada hutang.
                    </small>

                </div>

            </div>



            {{-- =================================================
                 STATUS PEMBAYARAN
            ================================================== --}}

            <div
                id="status-pembayaran"
                class="alert alert-success payment-status mb-0"
            >
                ✓ Pembayaran lunas.
            </div>


        </div>

    </div>

</div>



{{-- =========================================================
     BUTTON
========================================================= --}}

<div class="d-flex justify-content-end gap-2 mb-4">

    <a
        href="{{ route('penjualan.index') }}"
        class="btn btn-outline-secondary px-4"
    >
        Batal
    </a>

    <button
        type="submit"
        class="btn btn-primary px-4"
    >
        💾 Simpan & Buat Nota
    </button>

</div>


</form>



{{-- =========================================================
     STYLE
========================================================= --}}

<style>

/* =========================================================
   PAYMENT CARD
========================================================= */

.payment-card {
    border: 0;
    border-radius: 12px;
}

.payment-header {
    padding-bottom: 15px;
    border-bottom: 1px solid #eeeeee;
}


/* =========================================================
   PAYMENT SUMMARY
========================================================= */

.payment-summary {
    width: 100%;
}


/* =========================================================
   PAYMENT ROW
========================================================= */

.payment-row {

    display: grid;

    grid-template-columns: 1fr 260px;

    align-items: center;

    gap: 30px;

    width: 100%;

    min-height: 62px;

    padding: 14px 0;

    border-bottom: 1px solid #eeeeee;
}


.payment-label-box {
    min-width: 0;
}


.payment-label {
    color: #475569;
    font-size: 14px;
}


.payment-value {

    display: block;

    width: 100%;

    text-align: right;

    font-size: 15px;

    white-space: nowrap;
}


/* =========================================================
   DISKON INPUT
========================================================= */

.diskon-input {

    position: relative;

    width: 260px;

    justify-self: end;
}


.diskon-input input {

    width: 100%;

    height: 42px;

    padding-right: 40px;

    text-align: right;
}


.diskon-percent {

    position: absolute;

    right: 13px;

    top: 50%;

    transform: translateY(-50%);

    color: #6c757d;

    pointer-events: none;

}


/* =========================================================
   TOTAL
========================================================= */

.payment-total-box {

    display: grid;

    grid-template-columns: 1fr 260px;

    align-items: center;

    gap: 30px;

    width: 100%;

    margin-top: 20px;

    padding: 20px 22px;

    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 10px;
}


.payment-total-label {

    font-weight: 700;

    font-size: 14px;

    color: #334155;
}


.payment-total-value {

    width: 100%;

    text-align: right;

    color: #0d6efd;

    font-size: 21px;

    white-space: nowrap;
}


/* =========================================================
   PAYMENT SECTION
========================================================= */

.payment-section {

    width: 100%;

    margin-top: 24px;

    padding: 22px;

    background: #ffffff;

    border: 1px solid #e5e7eb;

    border-radius: 10px;
}


.payment-section-title {

    font-weight: 700;

    font-size: 15px;

    color: #334155;

    padding-bottom: 13px;

    margin-bottom: 20px;

    border-bottom: 1px solid #eeeeee;
}


/* =========================================================
   PAYMENT FIELD
========================================================= */

.payment-field {

    width: 100%;
}


.payment-field + .payment-field {

    margin-top: 22px;
}


.payment-field .form-label {

    display: block;

    margin-bottom: 8px;
}


.payment-field .input-group {

    width: 100%;
}


.payment-field .input-group-text {

    width: 52px;

    min-width: 52px;

    justify-content: center;

    background: #f8fafc;

    font-weight: 600;
}


#bayar_cash,
#hutang {

    height: 44px;
}


#bayar_cash {

    text-align: right;
}


#hutang {

    background-color: #f8f9fa;

    font-weight: 600;

    text-align: right;

    cursor: not-allowed;
}


#hutang-keterangan {

    display: block;

    margin-top: 7px;

    font-size: 13px;
}


/* =========================================================
   STATUS PEMBAYARAN
========================================================= */

.payment-status {

    width: 100%;

    margin-top: 18px;

    padding: 13px 16px;

    font-size: 14px;
}


/* =========================================================
   BARANG
========================================================= */

.barang-row {

    border-bottom: 1px solid #eeeeee;

    padding-bottom: 15px;
}


.barang-row:last-child {

    border-bottom: none;
}


/* =========================================================
   DESKTOP
========================================================= */

@media (min-width: 992px) {

    .payment-summary {

        width: 100%;

    }

}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .payment-row {

        grid-template-columns: 1fr 220px;

        gap: 20px;

    }


    .payment-total-box {

        grid-template-columns: 1fr 220px;

        gap: 20px;

    }


    .diskon-input {

        width: 220px;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 576px) {

    .payment-card .card-body {

        padding: 18px !important;

    }


    .payment-row {

        display: flex;

        flex-direction: column;

        align-items: stretch;

        gap: 9px;

        min-height: auto;

    }


    .payment-value {

        width: 100%;

        text-align: left;

    }


    .diskon-input {

        width: 100%;

        justify-self: auto;

    }


    .payment-total-box {

        display: flex;

        flex-direction: column;

        align-items: stretch;

        gap: 10px;

        padding: 17px;

    }


    .payment-total-value {

        width: 100%;

        text-align: left;

        font-size: 19px;

    }


    .payment-section {

        padding: 17px;

    }

}

</style>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>


/*
|--------------------------------------------------------------------------
| FORMAT RUPIAH
|--------------------------------------------------------------------------
*/

function formatRupiah(angka)
{

    angka = Number(angka) || 0;

    return 'Rp ' +
        angka.toLocaleString('id-ID');

}



/*
|--------------------------------------------------------------------------
| HITUNG TOTAL PENJUALAN
|--------------------------------------------------------------------------
*/

function hitungTotal()
{

    let subtotal = 0;


    document
        .querySelectorAll('.barang-row')
        .forEach(row => {


            const select =
                row.querySelector('.barang-select');


            const option =
                select.options[select.selectedIndex];


            const harga =
                Number(
                    option?.dataset.harga || 0
                );


            const koli =
                Number(
                    row.querySelector('.jumlah-koli').value || 0
                );


            const pcs =
                Number(
                    row.querySelector('.jumlah-pcs').value || 0
                );


            const pcsPerKoli =
                Number(
                    option?.dataset.koli || 1
                );


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


            /*
            |--------------------------------------------------------------------------
            | TAMPILKAN HARGA
            |--------------------------------------------------------------------------
            */

            const hargaDisplay =
                row.querySelector('.harga-display');


            if (hargaDisplay) {

                hargaDisplay.value =
                    formatRupiah(harga);

            }

        });



    /*
    |--------------------------------------------------------------------------
    | DISKON
    |--------------------------------------------------------------------------
    */

    let diskon =
        Number(
            document.getElementById('diskon').value || 0
        );


    if (diskon < 0) {

        diskon = 0;

    }


    if (diskon > 100) {

        diskon = 100;

    }



    /*
    |--------------------------------------------------------------------------
    | JUMLAH DISKON
    |--------------------------------------------------------------------------
    */

    const jumlahDiskon =
        subtotal * (diskon / 100);



    /*
    |--------------------------------------------------------------------------
    | TOTAL AKHIR
    |--------------------------------------------------------------------------
    */

    const total =
        Math.max(
            0,
            subtotal - jumlahDiskon
        );



    /*
    |--------------------------------------------------------------------------
    | SUBTOTAL DISPLAY
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'subtotal-display'
    ).textContent =
        formatRupiah(subtotal);



    /*
    |--------------------------------------------------------------------------
    | DISKON DISPLAY
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'diskon-display'
    ).textContent =
        '- ' +
        formatRupiah(jumlahDiskon);



    /*
    |--------------------------------------------------------------------------
    | TOTAL DISPLAY
    |--------------------------------------------------------------------------
    */

    document.getElementById(
        'total-display'
    ).textContent =
        formatRupiah(total);



    /*
    |--------------------------------------------------------------------------
    | HITUNG PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    hitungPembayaran(total);

}



/*
|--------------------------------------------------------------------------
| HITUNG BAYAR CASH & HUTANG
|--------------------------------------------------------------------------
*/

function hitungPembayaran(total)
{

    const bayarCashInput =
        document.getElementById('bayar_cash');


    const hutangInput =
        document.getElementById('hutang');


    const statusPembayaran =
        document.getElementById(
            'status-pembayaran'
        );


    const hutangKeterangan =
        document.getElementById(
            'hutang-keterangan'
        );



    /*
    |--------------------------------------------------------------------------
    | BAYAR CASH
    |--------------------------------------------------------------------------
    */

    let bayarCash =
        Number(
            bayarCashInput.value || 0
        );



    /*
    |--------------------------------------------------------------------------
    | CASH TIDAK BOLEH NEGATIF
    |--------------------------------------------------------------------------
    */

    if (bayarCash < 0) {

        bayarCash = 0;

        bayarCashInput.value = 0;

    }



    /*
    |--------------------------------------------------------------------------
    | CASH TIDAK BOLEH LEBIH BESAR DARI TOTAL
    |--------------------------------------------------------------------------
    */

    if (bayarCash > total) {

        bayarCash = total;

        bayarCashInput.value =
            total;

    }



    /*
    |--------------------------------------------------------------------------
    | HITUNG HUTANG
    |--------------------------------------------------------------------------
    */

    const hutang =
        Math.max(
            0,
            total - bayarCash
        );



    /*
    |--------------------------------------------------------------------------
    | ISI INPUT HUTANG
    |--------------------------------------------------------------------------
    */

    hutangInput.value =
        Math.round(hutang);



    /*
    |--------------------------------------------------------------------------
    | STATUS PEMBAYARAN
    |--------------------------------------------------------------------------

    */

    if (total <= 0) {


        statusPembayaran.className =
            'alert alert-secondary payment-status mb-0';


        statusPembayaran.textContent =
            'Belum ada barang yang dipilih.';


        hutangKeterangan.textContent =
            'Belum ada total pembayaran.';

    }


    else if (hutang <= 0) {


        statusPembayaran.className =
            'alert alert-success payment-status mb-0';


        statusPembayaran.textContent =
            '✓ Pembayaran lunas.';


        hutangKeterangan.textContent =
            'Tidak ada hutang.';

    }


    else {


        statusPembayaran.className =
            'alert alert-warning payment-status mb-0';


        statusPembayaran.textContent =
            '⚠️ Pembayaran belum lunas. Customer masih memiliki hutang ' +
            formatRupiah(hutang) +
            '.';


        hutangKeterangan.textContent =
            'Sisa hutang customer: ' +
            formatRupiah(hutang);

    }

}



/*
|--------------------------------------------------------------------------
| TAMBAH BARANG
|--------------------------------------------------------------------------
*/

function tambahBarang()
{

    const container =
        document.getElementById(
            'barang-container'
        );


    const firstRow =
        document.querySelector(
            '.barang-row'
        );


    const newRow =
        firstRow.cloneNode(true);



    /*
    |--------------------------------------------------------------------------
    | RESET SELECT
    |--------------------------------------------------------------------------
    */

    const select =
        newRow.querySelector(
            '.barang-select'
        );


    select.value = '';



    /*
    |--------------------------------------------------------------------------
    | RESET KOLI
    |--------------------------------------------------------------------------
    */

    newRow
        .querySelector(
            '.jumlah-koli'
        )
        .value = 0;



    /*
    |--------------------------------------------------------------------------
    | RESET PCS
    |--------------------------------------------------------------------------
    */

    newRow
        .querySelector(
            '.jumlah-pcs'
        )
        .value = 0;



    /*
    |--------------------------------------------------------------------------
    | RESET HARGA
    |--------------------------------------------------------------------------
    */

    newRow
        .querySelector(
            '.harga-display'
        )
        .value = 'Rp 0';



    /*
    |--------------------------------------------------------------------------
    | TAMBAHKAN BARIS
    |--------------------------------------------------------------------------
    */

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
        document.querySelectorAll(
            '.barang-row'
        );


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
| PERUBAHAN BARANG
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'change',
    function(event)
    {

        if (
            event.target.classList.contains(
                'barang-select'
            )
        ) {


            const select =
                event.target;


            const option =
                select.options[
                    select.selectedIndex
                ];


            const harga =
                Number(
                    option?.dataset.harga || 0
                );


            const row =
                select.closest(
                    '.barang-row'
                );


            const display =
                row.querySelector(
                    '.harga-display'
                );


            display.value =
                formatRupiah(harga);


            hitungTotal();

        }

    }
);



/*
|--------------------------------------------------------------------------
| INPUT JUMLAH BARANG / DISKON / CASH
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'input',
    function(event)
    {

        if (

            event.target.classList.contains(
                'jumlah-koli'
            )

            ||

            event.target.classList.contains(
                'jumlah-pcs'
            )

            ||

            event.target.id === 'diskon'

            ||

            event.target.id === 'bayar_cash'

        ) {

            hitungTotal();

        }

    }
);



/*
|--------------------------------------------------------------------------
| HALAMAN SELESAI DIMUAT
|--------------------------------------------------------------------------
*/

document.addEventListener(
    'DOMContentLoaded',
    function()
    {

        hitungTotal();

    }
);

</script>

@endsection