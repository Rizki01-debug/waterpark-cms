<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('backend.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('backend.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $data = $request->only('judul', 'deskripsi', 'status');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gallery', 'public');
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('backend.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
            'status' => 'boolean',
        ]);

        $data = $request->only('judul', 'deskripsi', 'status');

        if ($request->hasFile('gambar')) {
            if ($gallery->gambar) Storage::delete('public/'.$gallery->gambar);
            $data['gambar'] = $request->file('gambar')->store('gallery', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->gambar) Storage::delete('public/'.$gallery->gambar);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
