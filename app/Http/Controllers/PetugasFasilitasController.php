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

    /* =========================
       GUEST INDEX
    ========================== */
    /* =========================================
       LOGIKA GUEST (PENGUNJUNG)
    ========================================= */

   public function guestIndex(Request $request)
    {
        // 1. Ambil daftar Jabatan/Peran unik untuk dropdown filter
        $listPeran = PetugasFasilitas::select('peran')->distinct()->pluck('peran');

        // 2. Mulai Query
        $query = PetugasFasilitas::with(['fasilitas', 'warga']);

        // 3. Logika SEARCH (Cari Nama Petugas atau Nama Fasilitas)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Cari di tabel Warga (Relasi)
                $q->whereHas('warga', function($w) use ($search) {
                    $w->where('nama', 'like', '%' . $search . '%');
                })
                // ATAU Cari di tabel Fasilitas (Relasi)
                ->orWhereHas('fasilitas', function($f) use ($search) {
                    $f->where('nama', 'like', '%' . $search . '%');
                });
            });
        }

        // 4. Logika FILTER JABATAN
        if ($request->filled('peran')) {
            $query->where('peran', $request->peran);
        }

        // 5. Eksekusi Data
        $items = $query->paginate(3)->withQueryString();

        return view('guest.petugas.index', compact('items', 'listPeran'));
    }
}
