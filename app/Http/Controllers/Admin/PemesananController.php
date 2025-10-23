<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    /**
     * 🔹 Menampilkan daftar pemesanan
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $pemesanans = Pemesanan::when($search, function ($query, $search) {
                $query->where('nama_pemesan', 'like', "%{$search}%");
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('backend.reservasi.pemesanan.index', compact('pemesanans', 'search'));
    }

    /**
     * 🔹 Menampilkan detail pemesanan (AJAX / Modal)
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::with('tiket')->findOrFail($id);
        return response()->json($pemesanan);
    }

    /**
     * 🔹 Update status pemesanan (Setujui / Tolak)
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Konfirmasi,Batal,Berhasil',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', '✅ Status pemesanan berhasil diperbarui!');
    }

    /**
     * 🔹 Hapus data pemesanan
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        if ($pemesanan->bukti_pembayaran) {
            Storage::disk('public')->delete($pemesanan->bukti_pembayaran);
        }

        $pemesanan->delete();

        return redirect()->back()->with('success', '🗑️ Data pemesanan berhasil dihapus!');
    }
}
