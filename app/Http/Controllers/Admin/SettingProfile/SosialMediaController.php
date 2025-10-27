<?php

namespace App\Http\Controllers\Admin\SettingProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySocial;

class SosialMediaController extends Controller
{
    public function index()
    {
        $social = CompanySocial::first();
        return view('backend.settingprofile.sosialmedia.index', compact('social'));
    }

    public function create()
    {
        return view('backend.settingprofile.sosialmedia.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        CompanySocial::updateOrCreate(['id' => 1], $validated);

        return redirect()->route('admin.settingprofile.sosial.index')
            ->with('success', 'Data sosial media berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $social = CompanySocial::findOrFail($id);
        return view('backend.settingprofile.sosialmedia.edit', compact('social'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        $social = CompanySocial::findOrFail($id);
        $social->update($validated);

        return redirect()->route('admin.settingprofile.sosial.index')
            ->with('success', 'Data sosial media berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        CompanySocial::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data sosial media berhasil dihapus!');
    }
}
