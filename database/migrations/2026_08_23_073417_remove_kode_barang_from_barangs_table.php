<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('barangs', 'kode_barang')) {

            Schema::table('barangs', function (Blueprint $table) {
                $table->dropColumn('kode_barang');
            });

        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('barangs', 'kode_barang')) {

            Schema::table('barangs', function (Blueprint $table) {
                $table->string('kode_barang')
                    ->nullable()
                    ->unique();
            });

        }
    }
};