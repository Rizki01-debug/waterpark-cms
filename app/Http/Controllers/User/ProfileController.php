<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <<< penting
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // ambil user sebagai Eloquent model
        $user = User::find(Auth::id());
        return view('frontend.user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // selalu ambil sebagai Eloquent model supaya bisa fill() & save()
        $user = User::find(Auth::id());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // jika ada file avatar, simpan ke storage/public/avatars
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;

            // hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        // isi dan simpan model
        $user->fill($validated);
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
