<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->string('edisi', 100)->nullable()->after('tanggal_input');
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn('edisi');
        });
    }
};