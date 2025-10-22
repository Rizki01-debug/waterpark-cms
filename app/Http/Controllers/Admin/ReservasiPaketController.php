<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservasiPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservasiPaketController extends Controller
{
    public function index()
    {
        $paket = ReservasiPaket::latest()->paginate(10);
        return view('backend.reservasi.paket-tiket.index', compact('paket'));
    }

    public function create()
    {
        return view('backend.reservasi.paket-tiket.create');
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
            $validated['gambar'] = $request->file('gambar')->store('paket', 'public');
        }

        ReservasiPaket::create($validated);
        return redirect()->route('admin.reservasi.paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit(ReservasiPaket $paket)
    {
        return view('backend.reservasi.paket-tiket.edit', compact('paket'));
    }

    public function update(Request $request, ReservasiPaket $paket)
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
            if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
                Storage::disk('public')->delete($paket->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('paket', 'public');
        }

        $paket->update($validated);
        return redirect()->route('admin.reservasi.paket.index')->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy(ReservasiPaket $paket)
    {
        if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->delete();
        return redirect()->route('admin.reservasi.paket.index')->with('success', 'Paket berhasil dihapus!');
    }
}
