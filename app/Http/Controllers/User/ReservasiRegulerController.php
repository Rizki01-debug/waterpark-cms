<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReservasiReguler;

class ReservasiRegulerController extends Controller
{
    public function index()
    {
        $tiket = ReservasiReguler::where('status', 'aktif')->get();
        return view('frontend.reservasi.reguler.index', compact('tiket'));
    }
}
