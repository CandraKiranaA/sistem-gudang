<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {

            // JUMLAH KOLI
            $table->integer('jumlah_koli')
                ->default(1)
                ->after('barang_id');

            // JUMLAH PCS
            $table->integer('jumlah_pcs')
                ->default(0)
                ->after('jumlah_koli');

            // HARGA BELI / KOLI
            $table->decimal('harga_beli_koli', 15, 2)
                ->default(0)
                ->after('jumlah_pcs');

            // HARGA JUAL / KOLI
            $table->decimal('harga_jual_koli', 15, 2)
                ->default(0)
                ->after('harga_beli_koli');

            // HARGA JUAL / PCS
            $table->decimal('harga_jual_pcs', 15, 2)
                ->default(0)
                ->after('harga_jual_koli');

        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {

            $table->dropColumn([
                'jumlah_koli',
                'jumlah_pcs',
                'harga_beli_koli',
                'harga_jual_koli',
                'harga_jual_pcs',
            ]);

        });
    }
};