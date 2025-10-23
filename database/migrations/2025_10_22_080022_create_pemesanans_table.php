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
            $table->foreignId('tiket_id')
                  ->nullable()
                  ->constrained('tikets')
                  ->nullOnDelete();
            $table->string('nama_pemesan');
            $table->string('email')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Konfirmasi', 'Batal', 'Berhasil'])->default('Konfirmasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
