<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        // Validasi email
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email ini sudah terdaftar!',
        ]);

        // Simpan ke database
        Newsletter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Terima kasih! Kamu berhasil berlangganan.');
    }
}
