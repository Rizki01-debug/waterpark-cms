<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservasiReguler extends Model
{
    use HasFactory;

    protected $table = 'reservasi_reguler';
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'diskon',
        'gambar',
        'status'
    ];
}
