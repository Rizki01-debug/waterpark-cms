<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tagline',
        'deskripsi',
        'logo_nav',
        'logo_footer',
        'favicon',
        'tanggal_berdiri',
    ];
}
