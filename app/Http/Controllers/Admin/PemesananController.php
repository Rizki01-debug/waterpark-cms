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
        $filterJenis = $request->query('jenis'); // filter tiket / penginapan

        $pemesanans = Pemesanan::when($search, function ($query, $search) {
                $query->where('nama_pemesan', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($filterJenis, function ($query, $filterJenis) {
                $query->where('jenis', $filterJenis);
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('backend.reservasi.pemesanan.index', compact('pemesanans', 'search', 'filterJenis'));
    }

    /**
     * 🔹 Menampilkan detail pemesanan (AJAX / Modal)
     */
    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return response()->json($pemesanan);
    }

    /**
     * 🔹 Menambahkan pemesanan baru (opsional jika admin input manual)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'total' => 'required|numeric|min:0',
            'jenis' => 'required|in:tiket,penginapan',
            'status' => 'required|in:Konfirmasi,Batal,Berhasil',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        Pemesanan::create($validated);

        return redirect()->back()->with('success', '✅ Pemesanan baru berhasil ditambahkan!');
    }

    /**
     * 🔹 Update status pemesanan (Konfirmasi / Batal / Berhasil)
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
