<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $admins = User::where('role', 'admin')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('backend.system.admins.index', compact('admins', 'search'));
    }

    public function create()
    {
        return view('backend.system.admins.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'admin', // ✅
    ]);

    return redirect()->route('admin.system.admins.index')
        ->with('success', 'Admin berhasil ditambahkan!');
}

    public function edit(User $admin)
    {
        return view('backend.system.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);

        return redirect()->route('admin.system.admins.index')->with('success', 'Data admin berhasil diperbarui!');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->back()->with('success', 'Admin berhasil dihapus!');
    }
}
