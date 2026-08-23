<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {

            $table->date('tanggal_input')
                ->after('id');

        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {

            $table->dropColumn('tanggal_input');

        });
    }
};