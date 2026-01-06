<?php

namespace App\Http\Controllers;

use App\Models\SyaratFasilitas;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class SyaratFasilitasController extends Controller
{
    // List semua syarat
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page ?? 10;

        $data = SyaratFasilitas::with('fasilitas')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('fasilitas', function($f) use ($search) {
                    $f->where('nama', 'like', "%$search%");
                });
            })
            ->paginate($perPage)
            ->appends($request->all());

        return view('admin.syarat.index', compact('data'));
    }

    // Form tambah syarat
    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        return view('admin.syarat.create', compact('fasilitas'));
    }

    // Simpan syarat
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat'  => 'required',
            'deskripsi'    => 'nullable',
        ]);

        SyaratFasilitas::create($request->all());

        return redirect()->route('syarat.index')
            ->with('success', 'Syarat fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = SyaratFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();

        return view('admin.syarat.edit', compact('data', 'fasilitas'));
    }

    // Update syarat
    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat'  => 'required',
            'deskripsi'    => 'nullable',
        ]);

        $data = SyaratFasilitas::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('syarat.index')
            ->with('success', 'Syarat fasilitas berhasil diperbarui!');
    }

    // Hapus syarat
    public function destroy($id)
    {
        $data = SyaratFasilitas::findOrFail($id);
        $data->delete();

        return redirect()->route('syarat.index')
            ->with('success', 'Syarat fasilitas berhasil dihapus!');
    }

    /* =========================
       GUEST INDEX
    ========================== */
   /* =========================================
       LOGIKA GUEST (PENGUNJUNG)
    ========================================= */

    public function guestIndex()
    {
        // Menampilkan syarat-syarat peminjaman
        $items = SyaratFasilitas::with('fasilitas')->get();

        // Mengarah ke: resources/views/guest/syarat/index.blade.php
        return view('guest.syarat.index', compact('items'));
    }
}
