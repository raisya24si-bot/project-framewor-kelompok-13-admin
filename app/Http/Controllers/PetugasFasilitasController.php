<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    public function index()
    {
        // PAGINATION DIBENERIN
        $data = PetugasFasilitas::with(['fasilitas', 'warga'])
            ->paginate(10);

        return view('admin.petugas.index', compact('data'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('admin.petugas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required',
        ]);

        PetugasFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PetugasFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('admin.petugas.edit', compact('data', 'fasilitas', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required',
        ]);

        $data = PetugasFasilitas::findOrFail($id);

        $data->update([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas fasilitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PetugasFasilitas::findOrFail($id);
        $data->delete();

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas fasilitas berhasil dihapus!');
    }
}
