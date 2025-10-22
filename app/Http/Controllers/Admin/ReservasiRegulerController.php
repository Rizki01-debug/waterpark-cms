<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservasiReguler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservasiRegulerController extends Controller
{
    public function index()
    {
        $tiket = ReservasiReguler::latest()->paginate(10);
        return view('backend.reservasi.reguler-tiket.index', compact('tiket'));
    }

    public function create()
    {
        return view('backend.reservasi.reguler-tiket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('reservasi_reguler', 'public');
        }

        ReservasiReguler::create($validated);

        return redirect()->route('admin.reservasi.reguler.index')->with('success', 'Tiket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tiket = ReservasiReguler::findOrFail($id);
        return view('backend.reservasi.reguler-tiket.edit', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        $tiket = ReservasiReguler::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($tiket->gambar && Storage::disk('public')->exists($tiket->gambar)) {
                Storage::disk('public')->delete($tiket->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('reservasi_reguler', 'public');
        }

        $tiket->update($validated);
        return redirect()->route('admin.reservasi.reguler.index')->with('success', 'Tiket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $tiket = ReservasiReguler::findOrFail($id);

        if ($tiket->gambar && Storage::disk('public')->exists($tiket->gambar)) {
            Storage::disk('public')->delete($tiket->gambar);
        }

        $tiket->delete();

        return redirect()->route('admin.reservasi.reguler.index')->with('success', 'Tiket berhasil dihapus!');
    }
}
