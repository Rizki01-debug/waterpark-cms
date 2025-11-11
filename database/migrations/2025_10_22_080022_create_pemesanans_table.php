<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();

            $table->string('nota_path')->nullable();

            // Relasi User
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // Ganti tiket_id → reservasi_id (tanpa foreign key karena fleksibel)
            $table->unsignedBigInteger('reservasi_id')->nullable();

            // Kategori (reguler, paket, penginapan)
            $table->enum('kategori', ['reguler', 'paket', 'penginapan'])->nullable();

            // Data pemesan
            $table->string('nama_pemesan');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();

            // Transaksi
            $table->decimal('total', 12, 2)->nullable();
            $table->string('midtrans_order_id')->nullable();

            // Bukti & Status
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Pending', 'Konfirmasi', 'Batal', 'Berhasil'])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
