<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiPaket extends Model
{
    use HasFactory;

    protected $table = 'reservasi_paket';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'diskon',
        'gambar',
        'status',
    ];
}