<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
{
    $pemesanan = Pemesanan::where('user_id', Auth::id())
        ->latest()
        ->paginate(6);

    return view('frontend.user.pemesanan.index', compact('pemesanan'));
}


    public function downloadNota($id)
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())->findOrFail($id);

        if (!$pemesanan->nota_path || !file_exists(storage_path("app/public/{$pemesanan->nota_path}"))) {
            return redirect()->back()->with('error', 'Nota tidak ditemukan!');
        }

        return response()->download(storage_path("app/public/{$pemesanan->nota_path}"));
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())->findOrFail($id);
        $pemesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
