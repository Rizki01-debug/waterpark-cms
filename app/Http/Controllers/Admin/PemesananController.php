<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ Tambahkan ini agar tidak perlu \Pdf di bawah

class PemesananController extends Controller
{
    /**
     * ✅ Menampilkan daftar pemesanan
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $filterKategori = $request->query('kategori'); 

        $pemesanans = Pemesanan::when($search, function ($query, $search) {
                $query->where('nama_pemesan', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($filterKategori, function ($query, $filterKategori) {
                $query->where('kategori', $filterKategori);
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('backend.reservasi.pemesanan.index', compact('pemesanans', 'search', 'filterKategori'));
    }

    /**
     * ✅ Detail pemesanan via AJAX modal
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
    }

    /**
     * ✅ Update status manual (tanpa Midtrans)
     */
    public function updateStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $status = $request->get('status');

        // 🔹 Update status pemesanan
        $pemesanan->status = $status;
        $pemesanan->save();

        // 🔹 Jika status disetujui (Berhasil), buat nota otomatis
        if ($status === 'Berhasil') {
            // Pastikan folder "backend/nota/template.blade.php" tersedia
            $pdf = Pdf::loadView('backend.nota.template', [
                'pemesanan' => $pemesanan,
            ]);

            // Simpan file PDF ke storage/app/public/nota/
            $path = "nota/nota-{$pemesanan->id}.pdf";
            Storage::disk('public')->put($path, $pdf->output());

            // Update path ke kolom database
            $pemesanan->update(['nota_path' => $path]);
        }

        return back()->with('success', '✅ Status pesanan berhasil diperbarui.');
    }

    /**
     * ✅ Download Nota jika tersedia
     */
    public function downloadNota($id)
    {
        $order = Pemesanan::findOrFail($id);

        if (!$order->nota_path || !Storage::disk('public')->exists($order->nota_path)) {
            return back()->with('error', '❌ Nota tidak ditemukan!');
        }

        return response()->download(storage_path("app/public/{$order->nota_path}"));
    }

    /**
     * 🗑️ Hapus pesanan dan file notanya
     */
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);

        // Hapus file nota jika ada
        if ($pemesanan->nota_path && Storage::disk('public')->exists($pemesanan->nota_path)) {
            Storage::disk('public')->delete($pemesanan->nota_path);
        }

        $pemesanan->delete();

        return redirect()->back()->with('success', '🗑️ Pemesanan berhasil dihapus!');
    }
}
