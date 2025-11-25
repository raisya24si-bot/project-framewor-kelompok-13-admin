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
        $data = PetugasFasilitas::with('fasilitas', 'warga')->get();
        return view('petugas.index', compact('data'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        return view('petugas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required',
        ]);

        PetugasFasilitas::create($request->all());

        return redirect()->route('petugas.index')
            ->with('success', 'Petugas fasilitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PetugasFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        return view('petugas.edit', compact('data', 'fasilitas', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required',
        ]);

        $data = PetugasFasilitas::findOrFail($id);
        $data->update($request->all());

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
