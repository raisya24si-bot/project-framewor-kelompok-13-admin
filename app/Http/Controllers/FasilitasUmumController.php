<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    // Tampilkan semua fasilitas
   public function index(Request $request)
{
    // ambil keyword search
    $search = $request->search;
    $jenis = $request->jenis;

    // query dasar
    $query = FasilitasUmum::query();

    // Search berdasarkan nama / alamat
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
              ->orWhere('alamat', 'like', "%$search%");
        });
    }

    // Filter berdasarkan jenis fasilitas
    if ($jenis) {
        $query->where('jenis', $jenis);
    }

    // Pagination 10 data per halaman
    $data = $query->orderBy('fasilitas_id', 'DESC')
                  ->paginate(10)
                  ->appends($request->query());

    return view('fasilitas.index', compact('data'));
}


    // Form tambah fasilitas
    public function create()
    {
        return view('fasilitas.create');
    }

    // Simpan data fasilitas
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        FasilitasUmum::create($request->all());

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // Form edit fasilitas
    public function edit($id)
    {
        $data = FasilitasUmum::findOrFail($id);
        return view('fasilitas.edit', compact('data'));
    }

    // Update fasilitas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        $data = FasilitasUmum::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // Hapus fasilitas
    public function destroy($id)
    {
        $data = FasilitasUmum::findOrFail($id);

        // jika nanti ada media, bisa hapus otomatis di sini
        $data->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }
}
