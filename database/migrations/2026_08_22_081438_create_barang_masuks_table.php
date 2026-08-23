<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {

            $table->id();

            $table->date('tanggal_input');

            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->cascadeOnDelete();

            $table->integer('jumlah_koli')
                ->default(1);

            $table->integer('jumlah_pcs')
                ->default(0);

            $table->decimal('harga_beli_koli', 15, 2)
                ->default(0);

            $table->decimal('harga_jual_koli', 15, 2)
                ->default(0);

            $table->decimal('harga_jual_pcs', 15, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};