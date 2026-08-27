<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {

            $table->decimal('diskon', 5, 2)
                ->default(0)
                ->after('total');

            $table->decimal('bayar_cash', 15, 2)
                ->default(0)
                ->after('diskon');

            $table->decimal('hutang', 15, 2)
                ->default(0)
                ->after('bayar_cash');

        });
    }

    public function down(): void
    {
        Schema::table('penjualans', function (Blueprint $table) {

            $table->dropColumn([
                'diskon',
                'bayar_cash',
                'hutang',
            ]);

        });
    }
};