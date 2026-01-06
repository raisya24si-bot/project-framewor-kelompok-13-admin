<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * ========================
     * ADMIN
     * ========================
     */

    // List media (ADMIN)
    public function index()
    {
        $data = Media::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.media.index', compact('data'));
    }

    // Form upload media
    public function create()
    {
        return view('admin.media.create');
    }

    // Simpan media
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'file_url'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'caption'   => 'nullable|string',
        ]);

        $path = $request->file('file_url')->store('uploads/media', 'public');

        Media::create([
            'ref_table'  => $validated['ref_table'],
            'ref_id'     => $validated['ref_id'],
            'file_url'   => $path,
            'caption'    => $validated['caption'] ?? null,
            'mime_type'  => $request->file('file_url')->getMimeType(),
            'sort_order' => 0,
        ]);

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Media berhasil diupload!');
    }

    // Hapus media
    public function destroy($id)
    {
        $data = Media::findOrFail($id);

        if ($data->file_url && Storage::disk('public')->exists($data->file_url)) {
            Storage::disk('public')->delete($data->file_url);
        }

        $data->delete();

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Media berhasil dihapus!');
    }

    // Lihat media (ADMIN & GUEST)
    public function show($id)
{
    $media = Media::findOrFail($id);

    if (!Storage::disk('public')->exists($media->file_url)) {
        abort(404, 'File tidak ditemukan');
    }

    return view('admin.media.show', compact('media'));
}


    /**
     * ========================
     * GUEST
     * ========================
     */

    // List media untuk guest
    public function guestIndex()
    {
        $media = Media::orderBy('created_at', 'desc')
            ->whereIn('mime_type', ['image/jpeg', 'image/png'])
            ->paginate(12);

        return view('guest.media.index', compact('media'));
    }
}
