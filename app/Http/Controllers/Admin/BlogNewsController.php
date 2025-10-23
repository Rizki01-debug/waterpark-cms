<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogNewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $news = News::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%");
        })->orderBy('id', 'desc')->paginate(10);

        return view('backend.blog.news.index', compact('news', 'search'));
    }

    public function create()
    {
        return view('backend.blog.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'nullable|string',
            'penulis' => 'nullable|string',
            'status' => 'required|in:Publish,Draft',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        News::create($validated);

        return redirect()->route('admin.blog.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        return view('backend.blog.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori' => 'nullable|string',
            'penulis' => 'nullable|string',
            'status' => 'required|in:Publish,Draft',
            'tanggal' => 'nullable|date',
        ]);

        if ($request->hasFile('gambar')) {
            if ($news->gambar) {
                Storage::disk('public')->delete($news->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('news', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        $news->update($validated);

        return redirect()->route('admin.blog.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->gambar) {
            Storage::disk('public')->delete($news->gambar);
        }
        $news->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
