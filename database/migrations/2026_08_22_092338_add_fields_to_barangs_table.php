<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            $table->string('nama_barang')
                ->after('id');

            $table->string('satuan')
                ->after('nama_barang');

            $table->integer('jumlah_koli')
                ->default(1)
                ->after('satuan');

            $table->integer('pcs_per_koli')
                ->default(1)
                ->after('jumlah_koli');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            $table->dropColumn([
                'nama_barang',
                'satuan',
                'jumlah_koli',
                'pcs_per_koli',
            ]);
        });
    }
};