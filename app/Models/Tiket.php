<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan; // pastikan ada use ini

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tikets';

    protected $fillable = [
        'nama_tiket',
        'deskripsi',
        'harga',
        'gambar',
        'jenis',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'created_at' => 'datetime:d-m-Y H:i',
    ];

    /**
     * Relasi ke Pemesanan
     * Satu tiket bisa dipesan banyak orang.
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    /**
     * Helper untuk format harga dengan ribuan.
     */
    public function getHargaFormattedAttribute(): string
    {
        // pastikan nilai tidak null; cast ke float untuk safety
        $harga = $this->harga ?? 0;
        return 'Rp ' . number_format((float) $harga, 0, ',', '.');
    }

    /**
     * Helper untuk menampilkan badge status aktif/nonaktif di BE.
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'Aktif' => '<span class="badge bg-success">Aktif</span>',
            'Nonaktif' => '<span class="badge bg-secondary">Nonaktif</span>',
            default => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }
}
