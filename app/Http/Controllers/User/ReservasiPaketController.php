<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReservasiPaket;

class ReservasiPaketController extends Controller
{
    public function index()
    {
        // Ambil paket aktif (status = 1)
        $paket = ReservasiPaket::where('status', 1)->paginate(6);

        return view('frontend.reservasi.paket.index', compact('paket'));
    }

    public function show($id)
    {
        $paket = ReservasiPaket::findOrFail($id);
        return view('frontend.reservasi.paket.show', compact('paket'));
    }
}
