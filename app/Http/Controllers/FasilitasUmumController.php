<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    // ===========================
    // INDEX (LIST DATA + FILTER)
    // ===========================
    public function index(Request $request)
    {
        $search = $request->search;
        $jenis  = $request->jenis;

        $query = FasilitasUmum::query();

        // Search nama / alamat
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
            });
        }

        // Filter jenis
        if ($jenis) {
            $query->where('jenis', $jenis);
        }

        // Pagination
        $data = $query->orderBy('fasilitas_id', 'DESC')
                      ->paginate(10)
                      ->appends($request->query());

        return view('admin.fasilitas.index', compact('data'));
    }

    // ===========================
    // FORM CREATE
    // ===========================
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    // ===========================
    // STORE DATA BARU
    // ===========================
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'jenis'     => 'required',
            'alamat'    => 'required',
            'rt'        => 'required',
            'rw'        => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sop'  => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = $request->except(['foto', 'sop']);

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fasilitas/foto', 'public');
        }

        // Upload SOP
        if ($request->hasFile('sop')) {
            $data['sop'] = $request->file('sop')->store('fasilitas/sop', 'public');
        }

        FasilitasUmum::create($data);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // ===========================
    // FORM EDIT
    // ===========================
    public function edit($id)
    {
        $data = FasilitasUmum::findOrFail($id);
        return view('admin.fasilitas.edit', compact('data'));
    }

    // ===========================
    // UPDATE DATA
    // ===========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required',
            'jenis'     => 'required',
            'alamat'    => 'required',
            'rt'        => 'required',
            'rw'        => 'required',
            'kapasitas' => 'required|integer',
            'deskripsi' => 'nullable',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sop'  => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = FasilitasUmum::findOrFail($id);
        $updateData = $request->except(['foto', 'sop']);

        // =============== FOTO UPDATE ===============
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }

            // Simpan foto baru
            $updateData['foto'] = $request->file('foto')->store('fasilitas/foto', 'public');
        }

        // =============== SOP UPDATE ===============
        if ($request->hasFile('sop')) {

            // Hapus sop lama jika ada
            if ($data->sop) {
                Storage::disk('public')->delete($data->sop);
            }

            // Simpan sop baru
            $updateData['sop'] = $request->file('sop')->store('fasilitas/sop', 'public');
        }

        // Update database
        $data->update($updateData);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    // ===========================
    // DELETE DATA
    // ===========================
    public function destroy($id)
    {
        $data = FasilitasUmum::findOrFail($id);

        // Hapus file foto & sop jika ada
        if ($data->foto) {
            Storage::disk('public')->delete($data->foto);
        }

        if ($data->sop) {
            Storage::disk('public')->delete($data->sop);
        }

        $data->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }
}
