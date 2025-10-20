<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah fasilitas aktif
        $fasilitasAktif = Fasilitas::where('status', true)->count();

        // Nanti kamu bisa tambahkan data lain juga di sini
        $totalPengunjung = 1254; // contoh dummy
        $reservasiHariIni = 324; // contoh dummy
        $pendapatanBulanIni = 'Rp 45.2Jt'; // contoh dummy

        return view('backend.dashboard', compact(
            'fasilitasAktif',
            'totalPengunjung',
            'reservasiHariIni',
            'pendapatanBulanIni'
        ));
    }
}
