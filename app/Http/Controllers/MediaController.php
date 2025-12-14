<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * List media
     */
    public function index()
    {
        $data = Media::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.media.index', compact('data'));
    }

    /**
     * Form upload media
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Simpan media
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'file_url'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'caption'   => 'nullable|string',
        ]);

        // upload file
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
            ->route('media.index')
            ->with('success', 'Media berhasil diupload!');
    }

    /**
     * Hapus media
     */
    public function destroy($id)
    {
        $data = Media::findOrFail($id);

        // hapus file fisik
        if ($data->file_url && Storage::disk('public')->exists($data->file_url)) {
            Storage::disk('public')->delete($data->file_url);
        }

        $data->delete();

        return redirect()
            ->route('media.index')
            ->with('success', 'Media berhasil dihapus!');
    }

    public function view($id)
{
    $media = Media::findOrFail($id);

    // pastikan file ada
    if (!Storage::disk('public')->exists($media->file_url)) {
        abort(404, 'File tidak ditemukan');
    }

    // tampilkan file
    return response()->file(
        storage_path('app/public/' . $media->file_url)
    );
}
}
