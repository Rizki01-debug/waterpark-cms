<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;

class BlogEventController extends Controller
{
    public function index()
    {
        // Menampilkan event yang status-nya aktif/publish
        $events = Event::whereIn('status', ['1', 'aktif', 'publish'])
            ->orderByDesc('tanggal')
            ->paginate(6);

        return view('frontend.blog.events.index', compact('events'));
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('frontend.blog.events.show', compact('event'));
    }
}
