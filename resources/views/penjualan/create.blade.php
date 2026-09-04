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

    <h5 class="section-title mb-3">
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
                class="form-control input-tegas"
                value="{{ old('nama_customer') }}"
                placeholder="Contoh: Toko Jaya"
                required
            >

        </div>


        {{-- TANGGAL --}}

        <div class="col-md-6">

            <label class="form-label fw-semibold">
                Tanggal & Jam Penjualan
            </label>

            <input
                type="datetime-local"
                name="tanggal_penjualan"
                id="tanggal_penjualan"
                class="form-control input-tegas"
                value="{{ old(
                    'tanggal_penjualan',
                    now()->timezone('Asia/Jakarta')->format('Y-m-d\TH:i')
                ) }}"
                required
            >

            <small class="text-muted">
                Waktu Indonesia Barat (WIB)
            </small>

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

            <h5 class="section-title mb-1">
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

        <div class="barang-row row g-2 mb-3 align-items-end">

            {{-- BARANG --}}

            <div class="col-lg-5 col-md-12">

                <label class="form-label fw-semibold">
                    Barang
                </label>

                <select
                    name="barang_id[]"
                    class="form-select barang-select input-tegas"
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
                    class="form-control jumlah-koli input-tegas angka-input"
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
                    class="form-control jumlah-pcs input-tegas angka-input"
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
                    class="form-control harga-display input-tegas harga-readonly"
                    value="Rp 0"
                    readonly
                >

            </div>


            {{-- RESET --}}

            <div class="col-lg-1 col-md-12">

                <button
                    type="button"
                    class="btn btn-outline-danger w-100 btn-reset"
                    onclick="hapusBarang(this)"
                    title="Reset barang"
                >
                    Reset
                </button>

            </div>

        </div>

    </div>


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

    <div class="payment-header mb-4">

        <h5 class="section-title mb-1">
            💰 Ringkasan Pembayaran
        </h5>

        <small class="text-muted">
            Periksa total pembayaran sebelum menyimpan nota.
        </small>

    </div>


    <div class="payment-summary">


        {{-- SUBTOTAL --}}

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



        {{-- DISKON NOMINAL --}}

        <div class="payment-row">

            <div class="payment-label-box">

                <label
                    for="diskon"
                    class="payment-label fw-semibold mb-1"
                >
                    Diskon
                </label>

                <small class="text-muted d-block">
                    Masukkan nominal potongan diskon dalam Rupiah.
                </small>

            </div>


            <div class="diskon-input">

                <div class="input-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="diskon"
                        id="diskon"
                        class="form-control input-tegas text-end"
                        value="{{ old('diskon', 0) }}"
                        min="0"
                        step="1"
                        placeholder="0"
                    >

                </div>

            </div>

        </div>



        {{-- POTONGAN DISKON --}}

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



        {{-- TOTAL --}}

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



        {{-- PEMBAYARAN CUSTOMER --}}

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

                <div class="input-group input-tegas-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="bayar_cash"
                        id="bayar_cash"
                        class="form-control input-tegas"
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

                <div class="input-group input-tegas-group">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="hutang"
                        id="hutang"
                        class="form-control input-tegas"
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



        {{-- STATUS PEMBAYARAN --}}

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

.input-tegas {

    min-height: 44px;

    border: 2px solid #cbd5e1 !important;

    border-radius: 8px;

    background-color: #ffffff;

    color: #1e293b;

    font-size: 14px;

    transition:
        border-color 0.15s ease,
        box-shadow 0.15s ease,
        background-color 0.15s ease;

}


.input-tegas:hover {

    border-color: #94a3b8 !important;

}


.input-tegas:focus {

    border-color: #0d6efd !important;

    box-shadow:
        0 0 0 3px rgba(13, 110, 253, 0.12) !important;

    outline: none;

}


select.input-tegas {

    cursor: pointer;

    padding-left: 12px;

}


.angka-input {

    text-align: center;

    font-weight: 600;

}


.harga-readonly {

    background-color: #f8fafc !important;

    color: #334155 !important;

    font-weight: 600;

}


.form-label {

    color: #334155;

    margin-bottom: 7px;

}


.section-title {

    color: #0d47a1;

    font-weight: 700;

}


.payment-card {

    border: 0;

    border-radius: 12px;

}


.payment-header {

    padding-bottom: 15px;

    border-bottom: 1px solid #eeeeee;

}


.payment-summary {

    width: 100%;

}


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
   DISKON NOMINAL
========================================================= */

.diskon-input {

    width: 260px;

    justify-self: end;

}


.diskon-input .input-group {

    width: 100%;

}


.diskon-input .input-group-text {

    height: 44px;

    background-color: #f1f5f9;

    border: 2px solid #cbd5e1;

    border-right: 0;

    font-weight: 700;

    color: #334155;

}


.diskon-input input {

    height: 44px;

    border-left: 0 !important;

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

    border: 1px solid #cbd5e1;

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


.payment-section {

    width: 100%;

    margin-top: 24px;

    padding: 22px;

    background: #ffffff;

    border: 2px solid #dbe3ec;

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


.input-tegas-group {

    border-radius: 8px;

}


.input-tegas-group .input-group-text {

    width: 55px;

    min-width: 55px;

    justify-content: center;

    background: #f1f5f9;

    border: 2px solid #cbd5e1;

    border-right: 0;

    font-weight: 700;

    color: #334155;

}


.input-tegas-group .input-tegas {

    border-left: 0 !important;

}


.input-tegas-group:focus-within .input-group-text {

    border-color: #0d6efd;

}


#bayar_cash,
#hutang {

    height: 44px;

}


#bayar_cash {

    text-align: right;

    font-size: 15px;

    font-weight: 600;

}


#hutang {

    background-color: #f8fafc !important;

    font-weight: 700;

    text-align: right;

    cursor: not-allowed;

}


.payment-status {

    width: 100%;

    margin-top: 18px;

    padding: 13px 16px;

    font-size: 14px;

}


.barang-row {

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    padding: 15px 10px;

    margin-left: 0;

    margin-right: 0;

    background: #ffffff;

}


.barang-row:hover {

    border-color: #cbd5e1;

}


.btn-reset {

    min-height: 44px;

}


.btn-primary {

    font-weight: 600;

}


.btn-outline-primary {

    font-weight: 600;

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


    .barang-row {

        padding: 15px;

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
| HITUNG TOTAL
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


            const totalPcs =
                (koli * pcsPerKoli) + pcs;


            subtotal +=
                totalPcs * harga;


            const hargaDisplay =
                row.querySelector('.harga-display');


            if (hargaDisplay) {

                hargaDisplay.value =
                    formatRupiah(harga);

            }

        });



    /*
    |--------------------------------------------------------------------------
    | DISKON NOMINAL
    |--------------------------------------------------------------------------
    */

    let diskon =
        Number(
            document.getElementById('diskon').value || 0
        );


    if (diskon < 0) {

        diskon = 0;

        document.getElementById('diskon').value = 0;

    }


    if (diskon > subtotal) {

        diskon = subtotal;

        document.getElementById('diskon').value =
            Math.round(subtotal);

    }


    const total =
        Math.max(
            0,
            subtotal - diskon
        );


    document.getElementById(
        'subtotal-display'
    ).textContent =
        formatRupiah(subtotal);


    document.getElementById(
        'diskon-display'
    ).textContent =
        '- ' + formatRupiah(diskon);


    document.getElementById(
        'total-display'
    ).textContent =
        formatRupiah(total);


    hitungPembayaran(total);

}



/*
|--------------------------------------------------------------------------
| HITUNG PEMBAYARAN
|--------------------------------------------------------------------------
*/

function hitungPembayaran(total)
{

    const bayarCashInput =
        document.getElementById('bayar_cash');

    const hutangInput =
        document.getElementById('hutang');

    const statusPembayaran =
        document.getElementById('status-pembayaran');

    const hutangKeterangan =
        document.getElementById('hutang-keterangan');


    let bayarCash =
        Number(
            bayarCashInput.value || 0
        );


    if (bayarCash < 0) {

        bayarCash = 0;

        bayarCashInput.value = 0;

    }


    if (bayarCash > total) {

        bayarCash = total;

        bayarCashInput.value = total;

    }


    const hutang =
        Math.max(
            0,
            total - bayarCash
        );


    hutangInput.value =
        Math.round(hutang);



    /*
    |--------------------------------------------------------------------------
    | STATUS
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
        document.getElementById('barang-container');

    const firstRow =
        document.querySelector('.barang-row');


    const newRow =
        firstRow.cloneNode(true);


    newRow.querySelector('.barang-select').value = '';

    newRow.querySelector('.jumlah-koli').value = 0;

    newRow.querySelector('.jumlah-pcs').value = 0;

    newRow.querySelector('.harga-display').value = 'Rp 0';


    container.appendChild(newRow);


    hitungTotal();

}



/*
|--------------------------------------------------------------------------
| RESET / HAPUS BARANG
|--------------------------------------------------------------------------
*/

function hapusBarang(button)
{

    const rows =
        document.querySelectorAll('.barang-row');


    if (rows.length <= 1) {

        const row =
            button.closest('.barang-row');


        row.querySelector('.barang-select').value = '';

        row.querySelector('.jumlah-koli').value = 0;

        row.querySelector('.jumlah-pcs').value = 0;

        row.querySelector('.harga-display').value = 'Rp 0';


        hitungTotal();

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
| INPUT JUMLAH / DISKON / CASH
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
