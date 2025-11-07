<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReservasiReguler;

class ReservasiRegulerController extends Controller
{
    /**
     * Menampilkan daftar tiket reguler aktif
     */
    public function index()
    {
        // Ambil tiket dengan status = 1 (aktif), tampilkan 6 per halaman
        $tiket = ReservasiReguler::where('status', 1)->paginate(6);

        return view('frontend.reservasi.reguler.index', compact('tiket'));
    }

    /**
     * Menampilkan detail tiket reguler
     */
    public function show($id)
    {
        $tiket = ReservasiReguler::findOrFail($id);

        return view('frontend.reservasi.reguler.show', compact('tiket'));
    }
}
