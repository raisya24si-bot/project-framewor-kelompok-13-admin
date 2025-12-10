<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeminjamanFasilitasController extends Controller
{
    // Tampilkan semua peminjaman
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->per_page ?? 10;

        $data = PeminjamanFasilitas::with('fasilitas', 'warga')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                })->orWhereHas('fasilitas', function ($f) use ($search) {
                    $f->where('nama', 'like', "%$search%");
                });
            })
            ->orderBy('pinjam_id', 'DESC')
            ->paginate($perPage)
            ->appends($request->all());

        return view('admin.peminjaman.index', compact('data'));
    }

    // Form tambah peminjaman
    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('admin.peminjaman.create', compact('fasilitas', 'warga'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required',
            'status' => 'required',
        ]);

        PeminjamanFasilitas::create($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $data = PeminjamanFasilitas::findOrFail($id);
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('admin.peminjaman.edit', compact('data', 'fasilitas', 'warga'));
    }

    // Update data peminjaman
    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required',
            'status' => 'required',
        ]);

        $data = PeminjamanFasilitas::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    // Hapus peminjaman
    public function destroy($id)
    {
        $data = PeminjamanFasilitas::findOrFail($id);
        $data->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
}
