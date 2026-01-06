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

    /* =========================
       GUEST INDEX
    ========================== */
    /* =========================================
       LOGIKA GUEST (PENGUNJUNG)
    ========================================= */

    public function guestIndex(Request $request)
    {
        // 1. Mulai Query
        $query = PeminjamanFasilitas::with(['fasilitas', 'warga']);

        // 2. Logika SEARCH (Cari Nama Kegiatan / Tujuan)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tujuan', 'like', '%' . $search . '%')
                  ->orWhereHas('fasilitas', function($f) use ($search) {
                      $f->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }

        // 3. Logika FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. Eksekusi Data
        $items = $query->orderBy('tanggal_mulai', 'desc')
                       ->paginate(3) // Menggunakan 9 item agar grid rapi
                       ->withQueryString(); // Filter tidak hilang saat pindah halaman

        return view('guest.peminjaman.index', compact('items'));
    }
}
