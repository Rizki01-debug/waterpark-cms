<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // Menampilkan semua data fasilitas
    public function index()
{
    // Ambil data fasilitas dengan pagination (10 per halaman)
    $fasilitas = Fasilitas::latest()->paginate(10);

    return view('backend.fasilitas.index', compact('fasilitas'));
}

    // Menampilkan form create
    public function create()
    {
        return view('backend.fasilitas.create');
    }

    // Simpan data fasilitas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fasilitas = new Fasilitas();
        $fasilitas->nama = $request->nama;
        $fasilitas->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('fasilitas', 'public');
            $fasilitas->gambar = $path;
        }

        $fasilitas->save();

        return redirect()->route('admin.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Fasilitas $fasilita)
    {
        return view('backend.fasilitas.edit', compact('fasilita'));
    }

    // Update data fasilitas
    public function update(Request $request, Fasilitas $fasilita)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fasilita->nama = $request->nama;
        $fasilita->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('fasilitas', 'public');
            $fasilita->gambar = $path;
        }

        $fasilita->save();

        return redirect()->route('admin.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // Hapus data fasilitas
    public function destroy(Fasilitas $fasilita)
    {
        if ($fasilita->gambar && file_exists(storage_path('app/public/' . $fasilita->gambar))) {
            unlink(storage_path('app/public/' . $fasilita->gambar));
        }

        $fasilita->delete();

        return redirect()->route('admin.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil dihapus!');
    }
}
