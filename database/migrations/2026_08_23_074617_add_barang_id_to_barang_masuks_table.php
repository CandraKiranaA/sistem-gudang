<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika kolom barang_id belum ada, baru tambahkan.
        if (!Schema::hasColumn('barang_masuks', 'barang_id')) {
            Schema::table('barang_masuks', function (Blueprint $table) {
                $table->foreignId('barang_id')
                    ->after('tanggal_input')
                    ->constrained('barangs')
                    ->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Hanya hapus jika kolom barang_id memang ada.
        if (Schema::hasColumn('barang_masuks', 'barang_id')) {
            Schema::table('barang_masuks', function (Blueprint $table) {
                $table->dropForeign(['barang_id']);
                $table->dropColumn('barang_id');
            });
        }
    }
};