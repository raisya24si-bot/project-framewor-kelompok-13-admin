<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
    {
        $query = FasilitasUmum::with('media');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->jenis) {
            $query->where('jenis', $request->jenis);
        }

        $data = $query->latest('fasilitas_id')->paginate(10);
        return view('admin.fasilitas.index', compact('data'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

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

        $fasilitas = FasilitasUmum::create(
            $request->except(['foto', 'sop'])
        );

        // ================= FOTO =================
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fasilitas/foto', 'public');

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $path,
                'mime_type' => $request->file('foto')->getMimeType(),
                'caption'   => 'Foto fasilitas',
            ]);
        }

        // ================= SOP =================
        if ($request->hasFile('sop')) {
            $path = $request->file('sop')->store('fasilitas/sop', 'public');

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $path,
                'mime_type' => $request->file('sop')->getMimeType(),
                'caption'   => 'SOP fasilitas',
            ]);
        }

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = FasilitasUmum::with('media')->findOrFail($id);
        return view('admin.fasilitas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasUmum::with('media')->findOrFail($id);

        $fasilitas->update(
            $request->except(['foto', 'sop'])
        );

        // ================= FOTO =================
        if ($request->hasFile('foto')) {
            $old = $fasilitas->media()->where('mime_type', 'like', 'image%')->first();

            if ($old) {
                Storage::disk('public')->delete($old->file_url);
                $old->delete();
            }

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('foto')->store('fasilitas/foto', 'public'),
                'mime_type' => $request->file('foto')->getMimeType(),
                'caption'   => 'Foto fasilitas',
            ]);
        }

        // ================= SOP =================
        if ($request->hasFile('sop')) {
            $old = $fasilitas->media()->where('mime_type', 'application/pdf')->first();

            if ($old) {
                Storage::disk('public')->delete($old->file_url);
                $old->delete();
            }

            Media::create([
                'ref_table' => 'fasilitas_umum',
                'ref_id'    => $fasilitas->fasilitas_id,
                'file_url'  => $request->file('sop')->store('fasilitas/sop', 'public'),
                'mime_type' => $request->file('sop')->getMimeType(),
                'caption'   => 'SOP fasilitas',
            ]);
        }

        return redirect()->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

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
