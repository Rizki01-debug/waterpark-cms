<?php

namespace App\Http\Controllers\Admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Storage;

class IdentitasDasarController extends Controller
{
    public function index()
    {
        $profile = CompanyProfile::first();
        return view('backend.settingprofile.identitasdasar.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_berdiri' => 'nullable|date',
            'logo_nav' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',
        ]);

        $profile = CompanyProfile::first() ?? new CompanyProfile();

        foreach (['logo_nav', 'logo_footer', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                if ($profile->$field) {
                    Storage::disk('public')->delete($profile->$field);
                }
                $validated[$field] = $request->file($field)->store('uploads/profile', 'public');
            }
        }

        $profile->fill($validated)->save();

        return back()->with('success', 'Identitas dasar berhasil disimpan!');
    }

    public function destroy()
    {
        $profile = CompanyProfile::first();
        if ($profile) {
            foreach (['logo_nav', 'logo_footer', 'favicon'] as $field) {
                if ($profile->$field) {
                    Storage::disk('public')->delete($profile->$field);
                }
            }
            $profile->delete();
        }

        return back()->with('success', 'Data berhasil dihapus!');
    }
}
