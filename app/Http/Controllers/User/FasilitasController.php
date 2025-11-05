<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('frontend.fasilitas.index', compact('fasilitas'));
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('frontend.fasilitas.show', compact('fasilitas'));
    }
}
