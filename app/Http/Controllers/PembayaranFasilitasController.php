<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;

class PembayaranFasilitasController extends Controller
{
    /**
     * Menampilkan daftar pembayaran
     */
    public function index()
    {
        $data = PembayaranFasilitas::with([
            'peminjaman.warga',
            'peminjaman.fasilitas'
        ])->paginate(10);

        return view('admin.pembayaran.index', compact('data'));
    }

    /**
     * Form tambah pembayaran
     */
    public function create()
    {
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();

        return view('admin.pembayaran.create', compact('peminjaman'));
    }

    /**
     * Simpan data pembayaran
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|numeric',
            'metode'     => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        PembayaranFasilitas::create($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    /**
     * Form edit pembayaran
     */
    public function edit($id)
    {
        $data = PembayaranFasilitas::findOrFail($id);
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();

        return view('admin.pembayaran.edit', compact('data', 'peminjaman'));
    }

    /**
     * Update data pembayaran
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'    => 'required|date',
            'jumlah'     => 'required|numeric',
            'metode'     => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $data = PembayaranFasilitas::findOrFail($id);
        $data->update($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    /**
     * Hapus data pembayaran
     */
    public function destroy($id)
    {
        $data = PembayaranFasilitas::findOrFail($id);
        $data->delete();

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}
