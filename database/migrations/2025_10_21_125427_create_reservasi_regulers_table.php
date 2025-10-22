<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi_reguler', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('diskon')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true); // aktif/nonaktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi_reguler');
    }
};
