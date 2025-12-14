<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $data = User::orderBy('id', 'DESC')->paginate(10);
        return view('user.index', compact('data'));
    }

    // Form create
    public function create()
    {
        return view('user.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role'     => 'required|in:admin,petugas',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ];

        // 🔥 SIMPAN AVATAR
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')
                ->store('avatars', 'public');
        }

        User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('user.edit', compact('data'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:users,email,' . $id,
            'role'   => 'required|in:admin,petugas',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 🔥 UPDATE AVATAR
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')
                ->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    // Hapus user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
