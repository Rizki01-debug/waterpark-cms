<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class BlogEventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $events = Event::when($search, function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%");
        })->orderBy('tanggal', 'desc')->paginate(10);

        return view('backend.blog.events.index', compact('events', 'search'));
    }

    public function create()
    {
        return view('backend.blog.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'status' => 'required|string',
            'penulis' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('admin.blog.events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        return view('backend.blog.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lokasi' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'status' => 'required|string',
            'penulis' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            if ($event->gambar) {
                Storage::disk('public')->delete($event->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('admin.blog.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->gambar) {
            Storage::disk('public')->delete($event->gambar);
        }
        $event->delete();
        return redirect()->back()->with('success', 'Event berhasil dihapus!');
    }
}
