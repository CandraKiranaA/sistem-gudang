<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan_details', function (Blueprint $table) {

            $table->id();

            // RELASI KE PENJUALAN
            $table->foreignId('penjualan_id')
                ->constrained('penjualans')
                ->cascadeOnDelete();

            // RELASI KE BARANG
            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->cascadeOnDelete();

            // JUMLAH KOLI
            $table->integer('jumlah_koli')->default(0);

            // JUMLAH PCS
            $table->integer('jumlah_pcs')->default(0);

            // HARGA JUAL
            $table->decimal('harga', 15, 2)->default(0);

            // SUBTOTAL
            $table->decimal('subtotal', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan_details');
    }
};