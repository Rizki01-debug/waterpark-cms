<?php

namespace App\Http\Controllers\Admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyContact;

class KontakLokasiController extends Controller
{
    public function index()
    {
        $kontak = CompanyContact::first();
        return view('backend.settingprofile.kontaklokasi.index', compact('kontak'));
    }

    public function create()
    {
        return view('backend.settingprofile.kontaklokasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'google_maps' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:100',
        ]);

        // 🧠 Filter otomatis link Google Maps
        if (!empty($validated['google_maps'])) {
            $validated['google_maps'] = $this->extractGoogleMapsSrc($validated['google_maps']);
        }

        CompanyContact::updateOrCreate(['id' => 1], $validated);

        return redirect()->route('admin.settingprofile.kontak.index')
            ->with('success', 'Kontak & lokasi berhasil disimpan!');
    }

    public function show(string $id)
    {
        $kontak = CompanyContact::findOrFail($id);
        return view('backend.settingprofile.kontaklokasi.show', compact('kontak'));
    }

    public function edit(string $id)
    {
        $kontak = CompanyContact::findOrFail($id);
        return view('backend.settingprofile.kontaklokasi.edit', compact('kontak'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'google_maps' => 'nullable|string',
            'jam_operasional' => 'nullable|string|max:100',
        ]);

        // 🧠 Filter otomatis link Google Maps
        if (!empty($validated['google_maps'])) {
            $validated['google_maps'] = $this->extractGoogleMapsSrc($validated['google_maps']);
        }

        $kontak = CompanyContact::findOrFail($id);
        $kontak->update($validated);

        return redirect()->route('admin.settingprofile.kontak.index')
            ->with('success', 'Kontak & lokasi berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kontak = CompanyContact::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.settingprofile.kontak.index')
            ->with('success', 'Data berhasil dihapus.');
    }

    /**
     * 🧩 Fungsi untuk ambil URL src dari kode embed Google Maps
     */
    private function extractGoogleMapsSrc($input)
    {
        // Kalau admin paste iframe penuh, ambil hanya bagian src
        if (preg_match('/src="([^"]+)"/', $input, $matches)) {
            return $matches[1];
        }

        // Kalau admin sudah paste link langsung, biarkan
        return $input;
    }
}
