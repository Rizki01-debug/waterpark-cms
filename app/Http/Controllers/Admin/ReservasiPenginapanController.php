<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservasiPenginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservasiPenginapanController extends Controller
{
    public function index()
    {
        $penginapan = ReservasiPenginapan::latest()->paginate(10);
        return view('backend.reservasi.penginapan.index', compact('penginapan'));
    }

    public function create()
    {
        return view('backend.reservasi.penginapan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'boolean'
        ]);

        $validated['diskon'] = $validated['diskon'] ?? 0;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('penginapan', 'public');
        }

        ReservasiPenginapan::create($validated);
        return redirect()->route('admin.reservasi.penginapan.index')->with('success', 'Data penginapan berhasil ditambahkan!');
    }

    public function edit(ReservasiPenginapan $penginapan)
    {
        return view('backend.reservasi.penginapan.edit', compact('penginapan'));
    }

    public function update(Request $request, ReservasiPenginapan $penginapan)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'boolean'
        ]);

        $validated['diskon'] = $validated['diskon'] ?? 0;

        if ($request->hasFile('gambar')) {
            if ($penginapan->gambar && Storage::disk('public')->exists($penginapan->gambar)) {
                Storage::disk('public')->delete($penginapan->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('penginapan', 'public');
        }

        $penginapan->update($validated);
        return redirect()->route('admin.reservasi.penginapan.index')->with('success', 'Data penginapan berhasil diperbarui!');
    }

    public function destroy(ReservasiPenginapan $penginapan)
    {
        if ($penginapan->gambar && Storage::disk('public')->exists($penginapan->gambar)) {
            Storage::disk('public')->delete($penginapan->gambar);
        }

        $penginapan->delete();
        return redirect()->route('admin.reservasi.penginapan.index')->with('success', 'Data penginapan berhasil dihapus!');
    }
}
