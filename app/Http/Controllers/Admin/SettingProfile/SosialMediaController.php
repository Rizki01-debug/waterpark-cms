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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $social = CompanySocial::first() ?? new CompanySocial();
        $social->fill($validated)->save();

        return back()->with('success', 'Sosial media berhasil disimpan!');
    }

    public function destroy()
    {
        $social = CompanySocial::first();
        if ($social) {
            $social->delete();
        }

        return back()->with('success', 'Data sosial media berhasil dihapus!');
    }
}
