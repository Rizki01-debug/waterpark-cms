<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // 🔹 Tambah kolom user_id untuk relasi ke tabel users
            if (!Schema::hasColumn('pemesanans', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->onDelete('cascade');
            }

            // 🔹 Tambah kolom midtrans_order_id untuk simpan ID transaksi Midtrans
            if (!Schema::hasColumn('pemesanans', 'midtrans_order_id')) {
                $table->string('midtrans_order_id')
                    ->nullable()
                    ->after('jenis');
            }
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            if (Schema::hasColumn('pemesanans', 'midtrans_order_id')) {
                $table->dropColumn('midtrans_order_id');
            }

            if (Schema::hasColumn('pemesanans', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });
    }
};
