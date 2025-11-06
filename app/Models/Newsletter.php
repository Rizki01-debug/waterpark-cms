<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    // 👇 Ini WAJIB untuk mengizinkan mass assignment
    protected $fillable = ['email'];
}
