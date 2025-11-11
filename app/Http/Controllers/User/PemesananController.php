<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Pemesanan;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\RedirectResponse;

class PemesananController extends Controller
{
    /**
     * 🔹 Menampilkan daftar pesanan user yang sedang login
     */
    public function index(): View
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())
            ->latest()
            ->paginate(6); // ✅ pagination aktif

        return view('frontend.user.pemesanan.index', compact('pemesanan'));
    }

    /**
     * 🔹 Download nota (PDF) setelah pembayaran berhasil
     */
    public function downloadNota($id): BinaryFileResponse|RedirectResponse
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())->findOrFail($id);

        // 🔒 Cegah download jika status belum berhasil
        if ($pemesanan->status !== 'Berhasil') {
            return redirect()->back()->with('error', 'Nota hanya tersedia setelah pembayaran berhasil.');
        }

        // 🔍 Cek apakah file nota benar-benar ada di storage/public
        if (!$pemesanan->nota_path || !Storage::disk('public')->exists($pemesanan->nota_path)) {
            return redirect()->back()->with('error', 'File nota tidak ditemukan di server.');
        }

        // 💾 Download file PDF
        return response()->download(storage_path("app/public/{$pemesanan->nota_path}"));
    }

    /**
     * 🔹 Menghapus pesanan user
     */
    public function destroy($id): RedirectResponse
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())->findOrFail($id);

        // 🧹 Hapus file nota jika ada
        if ($pemesanan->nota_path && Storage::disk('public')->exists($pemesanan->nota_path)) {
            Storage::disk('public')->delete($pemesanan->nota_path);
        }

        $pemesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
