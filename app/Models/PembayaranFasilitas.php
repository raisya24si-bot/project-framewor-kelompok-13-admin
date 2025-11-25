<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;

class PembayaranFasilitasController extends Controller
{
    public function index()
    {
        $data = PembayaranFasilitas::with('peminjaman')->get();
        return view('pembayaran.index', compact('data'));
    }

    public function create()
    {
        $peminjaman = PeminjamanFasilitas::all();
        return view('pembayaran.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'keterangan' => 'nullable',
        ]);

        PembayaranFasilitas::create($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = PembayaranFasilitas::findOrFail($id);
        $peminjaman = PeminjamanFasilitas::all();
        return view('pembayaran.edit', compact('data', 'peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pinjam_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'keterangan' => 'nullable',
        ]);

        $data = PembayaranFasilitas::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PembayaranFasilitas::findOrFail($id);
        $data->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}
