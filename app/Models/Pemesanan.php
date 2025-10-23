<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // nama tabel

    // Kolom yang bisa diisi secara mass assignment
    protected $fillable = [
        'nama_pemesan',
        'email',
        'telepon',
        'bukti_pembayaran',
        'status',
    ];

    // Default status jika tidak diisi
    protected $attributes = [
        'status' => 'Konfirmasi',
    ];

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}
