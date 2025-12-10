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
            'role'     => 'required|in:admin,petugas,warga', // role sesuai kebutuhan kamu
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

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
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,petugas,warga',
        ]);

        $user = User::findOrFail($id);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:5'
            ]);

            $user->password = Hash::make($request->password);
        }

        $user->save();

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
