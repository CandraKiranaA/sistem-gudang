<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            if (!Schema::hasColumn('barangs', 'nama_barang')) {
                $table->string('nama_barang')
                    ->after('id');
            }

            if (!Schema::hasColumn('barangs', 'satuan')) {
                $table->string('satuan')
                    ->after('nama_barang');
            }

            if (!Schema::hasColumn('barangs', 'jumlah_koli')) {
                $table->integer('jumlah_koli')
                    ->default(1)
                    ->after('satuan');
            }

            if (!Schema::hasColumn('barangs', 'pcs_per_koli')) {
                $table->integer('pcs_per_koli')
                    ->default(1)
                    ->after('jumlah_koli');
            }

        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            $columns = [];

            foreach ([
                'nama_barang',
                'satuan',
                'jumlah_koli',
                'pcs_per_koli'
            ] as $column) {

                if (Schema::hasColumn('barangs', $column)) {
                    $columns[] = $column;
                }

            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }

        });
    }
};