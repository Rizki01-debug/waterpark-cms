<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;

class BlogNewsController extends Controller
{
    public function index()
    {
        // Ambil berita aktif (status = 1)
        $news = News::where('status', 1)->orderByDesc('created_at')->paginate(6);

        return view('frontend.blog.news.index', compact('news'));
    }

    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('frontend.blog.news.show', compact('item'));
    }
}
