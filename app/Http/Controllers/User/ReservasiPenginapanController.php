<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReservasiPenginapan;

class ReservasiPenginapanController extends Controller
{
    public function index()
    {
        // Ambil hanya penginapan aktif (status = 1)
        $penginapan = ReservasiPenginapan::where('status', 1)->paginate(6);
        return view('frontend.reservasi.penginapan.index', compact('penginapan'));
    }

    public function show($id)
    {
        $penginapan = ReservasiPenginapan::findOrFail($id);
        return view('frontend.reservasi.penginapan.show', compact('penginapan'));
    }
}
