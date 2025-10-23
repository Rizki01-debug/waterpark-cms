<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'gambar',
        'kategori',
        'penulis',
        'status',
        'tanggal',
    ];

    // Auto buat slug saat simpan
    protected static function booted()
    {
        static::creating(function ($news) {
            $news->slug = Str::slug($news->judul);
        });
    }
}
