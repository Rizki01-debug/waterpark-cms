<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'judul',
        'gambar',
        'lokasi',
        'tanggal',
        'status',
        'penulis',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'created_at' => 'datetime:d-m-Y H:i',
    ];

    /**
     * 🧾 Helper: Format tanggal agar tampil indah di tampilan.
     */
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal
            ? Carbon::parse($this->tanggal)->translatedFormat('d F Y')
            : '-';
    }

    /**
     * 🧠 Helper: Badge status untuk halaman admin.
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'Publish' => '<span class="badge bg-success">Publish</span>',
            'Draft' => '<span class="badge bg-secondary">Draft</span>',
            default => '<span class="badge bg-light text-dark">Unknown</span>',
        };
    }

    /**
     * 🧩 Helper: Jika gambar tidak ada, tampilkan placeholder.
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('images/no-image.png');
    }
}
