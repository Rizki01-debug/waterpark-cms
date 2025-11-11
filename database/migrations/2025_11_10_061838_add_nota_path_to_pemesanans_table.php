<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom nota_path ke tabel pemesanans.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // 🔹 Menyimpan path file PDF nota
            if (!Schema::hasColumn('pemesanans', 'nota_path')) {
                $table->string('nota_path')
                      ->nullable()
                      ->after('bukti_pembayaran'); 
            }
        });
    }

    /**
     * Rollback migration (hapus kolom nota_path)
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            if (Schema::hasColumn('pemesanans', 'nota_path')) {
                $table->dropColumn('nota_path');
            }
        });
    }
};
