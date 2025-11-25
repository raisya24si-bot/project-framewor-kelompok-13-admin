<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $data = Media::all();
        return view('media.index', compact('data'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required',
            'ref_id' => 'required|integer',
            'file_url' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'caption' => 'nullable',
        ]);

        // Upload file
        $path = $request->file('file_url')->store('uploads', 'public');

        Media::create([
            'ref_table' => $request->ref_table,
            'ref_id' => $request->ref_id,
            'file_url' => $path,
            'caption' => $request->caption,
            'mime_type' => $request->file('file_url')->getMimeType(),
        ]);

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil diupload!');
    }

    public function destroy($id)
    {
        $data = Media::findOrFail($id);
        $data->delete();

        return redirect()->route('media.index')
            ->with('success', 'Media berhasil dihapus!');
    }
}
