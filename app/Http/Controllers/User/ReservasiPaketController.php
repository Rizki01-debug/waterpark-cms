<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReservasiPaket;

class ReservasiPaketController extends Controller
{
    public function index()
    {
        // hanya ambil data yang aktif
        $paket = ReservasiPaket::where('status', 'aktif')->paginate(6);

        return view('frontend.reservasi.paket.index', compact('paket'));
    }
}
