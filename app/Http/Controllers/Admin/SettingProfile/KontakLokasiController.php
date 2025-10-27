<?php

namespace App\Http\Controllers\Admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyContact;

class KontakLokasiController extends Controller
{
    public function index()
    {
        $contact = CompanyContact::first();
        return view('backend.settingprofile.kontaklokasi.index', compact('contact'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'google_maps' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:50',
        ]);

        $contact = CompanyContact::first() ?? new CompanyContact();
        $contact->fill($validated)->save();

        return back()->with('success', 'Kontak & Lokasi berhasil disimpan!');
    }

    public function destroy()
    {
        $contact = CompanyContact::first();
        if ($contact) {
            $contact->delete();
        }

        return back()->with('success', 'Data kontak & lokasi berhasil dihapus!');
    }
}
