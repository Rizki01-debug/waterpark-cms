<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('backend.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('banner', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    public function edit(Banner $banner)
    {
        return view('backend.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) Storage::delete('public/'.$banner->gambar);
            $data['gambar'] = $request->file('gambar')->store('banner', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->gambar) Storage::delete('public/'.$banner->gambar);
        $banner->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus!');
    }
}
