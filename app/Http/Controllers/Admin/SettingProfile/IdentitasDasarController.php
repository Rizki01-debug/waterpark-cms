<?php

namespace App\Http\Controllers\Admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Storage;

class IdentitasDasarController extends Controller
{
    // Menampilkan semua data profil
    public function index()
    {
        $profiles = CompanyProfile::latest()->paginate(10);
        return view('backend.settingprofile.identitasdasar.index', compact('profiles'));
    }

    // Halaman tambah data
    public function create()
    {
        return view('backend.settingprofile.identitasdasar.create');
    }

    // Simpan data baru
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

        foreach (['logo_nav', 'logo_footer', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('uploads/profile', 'public');
            }
        }

        CompanyProfile::create($validated);
        return redirect()->route('admin.settingprofile.identitas.index')
            ->with('success', 'Data identitas dasar berhasil ditambahkan!');
    }

    // Halaman edit data
    public function edit($id)
    {
        $profile = CompanyProfile::findOrFail($id);
        return view('backend.settingprofile.identitasdasar.edit', compact('profile'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $profile = CompanyProfile::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_berdiri' => 'nullable|date',
            'logo_nav' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',
        ]);

        foreach (['logo_nav', 'logo_footer', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                if ($profile->$field) {
                    Storage::disk('public')->delete($profile->$field);
                }
                $validated[$field] = $request->file($field)->store('uploads/profile', 'public');
            }
        }

        $profile->update($validated);
        return redirect()->route('admin.settingprofile.identitas.index')
            ->with('success', 'Data identitas dasar berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $profile = CompanyProfile::findOrFail($id);

        foreach (['logo_nav', 'logo_footer', 'favicon'] as $field) {
            if ($profile->$field) {
                Storage::disk('public')->delete($profile->$field);
            }
        }

        $profile->delete();
        return redirect()->route('admin.settingprofile.identitas.index')
            ->with('success', 'Data identitas dasar berhasil dihapus!');
    }
}
