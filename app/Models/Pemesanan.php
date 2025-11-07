<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans'; // nama tabel

    protected $fillable = [
        'user_id',
        'tiket_id',            // relasi ke tabel tiket (jika ada)
        'nama_pemesan',
        'email',
        'telepon',
        'bukti_pembayaran',
        'status',
        'total',               // total harga
        'jenis',               // tiket / penginapan
    ];

    protected $attributes = [
        'status' => 'Konfirmasi',
    ];

    /**
     * 🔗 Relasi ke tabel tiket
     * Satu pemesanan hanya punya satu tiket
     */
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id');
    }

    /**
     * 🔹 Scope untuk memfilter berdasarkan jenis
     * contoh: Pemesanan::tiket()->get()
     */
    public function scopeTiket($query)
    {
        return $query->where('jenis', 'tiket');
    }

    public function scopePenginapan($query)
    {
        return $query->where('jenis', 'penginapan');
    }

    /**
     * 🔹 Scope untuk filter tanggal (range)
     * contoh: Pemesanan::tanggal('2025-10-01', '2025-10-31')->get()
     */
    public function scopeTanggal($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    /**
     * 🔹 Getter untuk format total harga dengan "Rp"
     */
    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }
}
