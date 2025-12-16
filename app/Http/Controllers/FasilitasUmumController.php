<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    /* =========================
       INDEX
    ========================== */
    public function index(Request $request)
    {
        $query = FasilitasUmum::with('media');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $data = $query->latest('fasilitas_id')->paginate(10);

        return view('admin.fasilitas.index', compact('data'));
    }

    /* =========================
       CREATE
    ========================== */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /* =========================
       STORE
    ========================== */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'jenis'     => 'required',
            'alamat'    => 'required',
            'rt'        => 'required',
            'rw'        => 'required',
            'kapasitas' => 'required|integer',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sop'       => 'nullable|mimes:pdf|max:5120',
        ]);

        // simpan fasilitas
        $fasilitas = FasilitasUmum::create(
            $request->except(['foto', 'sop'])
        );

        /* ===== FOTO ===== */
        if ($request->hasFile('foto')) {
            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('foto')->store('fasilitas/foto', 'public'),
                'mime_type' => $request->file('foto')->getMimeType(), // image/*
                'caption'   => 'Foto fasilitas',
            ]);
        }

        /* ===== SOP ===== */
        if ($request->hasFile('sop')) {
            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('sop')->store('fasilitas/sop', 'public'),
                'mime_type' => 'application/pdf', // PAKSA PDF
                'caption'   => 'SOP fasilitas',
            ]);
        }

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    /* =========================
       EDIT
    ========================== */
    public function edit($id)
    {
        $data = FasilitasUmum::with('media')->findOrFail($id);
        return view('admin.fasilitas.edit', compact('data'));
    }

    /* =========================
       UPDATE
    ========================== */
    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasUmum::with('media')->findOrFail($id);

        // update data utama
        $fasilitas->update(
            $request->except(['foto', 'sop'])
        );

        /* ===== FOTO ===== */
        if ($request->hasFile('foto')) {

            $oldFoto = $fasilitas->media()
                ->where('mime_type', 'like', 'image%')
                ->first();

            if ($oldFoto) {
                Storage::disk('public')->delete($oldFoto->file_url);
                $oldFoto->delete();
            }

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('foto')->store('fasilitas/foto', 'public'),
                'mime_type' => $request->file('foto')->getMimeType(),
                'caption'   => 'Foto fasilitas',
            ]);
        }

        /* ===== SOP ===== */
        if ($request->hasFile('sop')) {

            $oldSop = $fasilitas->media()
                ->where('mime_type', 'application/pdf')
                ->first();

            if ($oldSop) {
                Storage::disk('public')->delete($oldSop->file_url);
                $oldSop->delete();
            }

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('sop')->store('fasilitas/sop', 'public'),
                'mime_type' => 'application/pdf', // PAKSA PDF
                'caption'   => 'SOP fasilitas',
            ]);
        }

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

    /* =========================
       DELETE
    ========================== */
    public function destroy($id)
    {
        $fasilitas = FasilitasUmum::with('media')->findOrFail($id);

        foreach ($fasilitas->media as $media) {
            Storage::disk('public')->delete($media->file_url);
            $media->delete();
        }

        $fasilitas->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus');
    }
}
