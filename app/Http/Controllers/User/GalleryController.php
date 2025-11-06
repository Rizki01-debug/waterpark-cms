<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('status', true)->latest()->paginate(9);
        return view('frontend.galeri.index', compact('galleries'));
    }
}
