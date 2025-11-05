<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Banner;
use App\Models\Fasilitas;
use App\Models\ReservasiPaket;
use App\Models\ReservasiPenginapan;
use App\Models\CompanyProfile;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil banner aktif
        $banner = Banner::where('status', true)->latest()->first();

        // Ambil fasilitas aktif
        $fasilitas = Fasilitas::where('status', true)->get();

        // Ambil paket aktif (berisi promo juga)
        $paket = ReservasiPaket::where('status', true)->get();

        // Ambil data penginapan aktif
        $penginapan = ReservasiPenginapan::where('status', true)->get();

        // Ambil identitas dasar perusahaan (nama, tagline, deskripsi)
        $companyProfile = CompanyProfile::first();

        // Kirim ke view FE
        return view('frontend.dashboard', compact(
            'banner', 'fasilitas', 'paket', 'penginapan', 'companyProfile'
        ));
    }
}
