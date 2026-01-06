<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\DB;

class PembayaranFasilitasController extends Controller
{
    /**
     * Menampilkan daftar pembayaran
     */
    public function index()
    {
        $data = PembayaranFasilitas::with([
            'peminjaman.warga',
            'peminjaman.fasilitas',
            'media'
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
    $request->validate([
        'pinjam_id'          => 'required|exists:peminjaman_fasilitas,pinjam_id',
        'tanggal'            => 'required|date',
        'jumlah'             => 'required|numeric|min:0',
        'metode'             => 'required|string',
        'bukti_pembayaran'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        'resi_pembayaran'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        'keterangan'         => 'nullable|string',
    ]);

    DB::beginTransaction();

    try {
        /** ===============================
         * 1. SIMPAN PEMBAYARAN
         * =============================== */
        $pembayaran = PembayaranFasilitas::create([
            'pinjam_id'  => $request->pinjam_id,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'metode'     => $request->metode,
            'keterangan' => $request->keterangan,
        ]);

        /** ===============================
         * 2. SIMPAN BUKTI PEMBAYARAN
         * =============================== */
        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')
                            ->store('pembayaran/bukti', 'public');

            Media::create([
                'ref_table' => 'pembayaran_fasilitas',
                'ref_id'    => $pembayaran->bayar_id,
                'file_url'  => $path,
                'mime_type' => $request->file('bukti_pembayaran')->getMimeType(),
                'caption'   => 'Bukti Pembayaran',
            ]);
        }

        /** ===============================
         * 3. SIMPAN RESI (JIKA ADA)
         * =============================== */
        if ($request->hasFile('resi_pembayaran')) {
            $path = $request->file('resi_pembayaran')
                            ->store('pembayaran/resi', 'public');

            Media::create([
                'ref_table' => 'pembayaran_fasilitas',
                'ref_id'    => $pembayaran->bayar_id,
                'file_url'  => $path,
                'mime_type' => $request->file('resi_pembayaran')->getMimeType(),
                'caption'   => 'Resi Pembayaran',
            ]);
        }

        /** ===============================
         * 4. UPDATE STATUS PEMINJAMAN
         * =============================== */
        PeminjamanFasilitas::where('pinjam_id', $request->pinjam_id)
            ->update(['status' => 'selesai']);

        DB::commit();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil disimpan');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors($e->getMessage());
    }
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
    $request->validate([
        'tanggal'          => 'required|date',
        'jumlah'           => 'required|numeric|min:0',
        'metode'           => 'required|string',
        'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        'resi_pembayaran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        'keterangan'       => 'nullable|string',
    ]);

    DB::beginTransaction();

    try {
        $pembayaran = PembayaranFasilitas::with('media')->findOrFail($id);

        /** =====================
         * UPDATE PEMBAYARAN
         * ===================== */
        $pembayaran->update([
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'metode'     => $request->metode,
            'keterangan' => $request->keterangan,
        ]);

        /** =====================
         * UPDATE BUKTI (JIKA ADA)
         * ===================== */
        if ($request->hasFile('bukti_pembayaran')) {

            $oldBukti = $pembayaran->media
                ->where('caption', 'Bukti Pembayaran')
                ->first();

            if ($oldBukti) {
                Storage::disk('public')->delete($oldBukti->file_url);
                $oldBukti->delete();
            }

            $path = $request->file('bukti_pembayaran')
                            ->store('pembayaran/bukti', 'public');

            Media::create([
                'ref_table' => 'pembayaran_fasilitas',
                'ref_id'    => $pembayaran->bayar_id,
                'file_url'  => $path,
                'mime_type' => $request->file('bukti_pembayaran')->getMimeType(),
                'caption'   => 'Bukti Pembayaran',
            ]);
        }

        /** =====================
         * UPDATE RESI (JIKA ADA)
         * ===================== */
        if ($request->hasFile('resi_pembayaran')) {

            $oldResi = $pembayaran->media
                ->where('caption', 'Resi Pembayaran')
                ->first();

            if ($oldResi) {
                Storage::disk('public')->delete($oldResi->file_url);
                $oldResi->delete();
            }

            $path = $request->file('resi_pembayaran')
                            ->store('pembayaran/resi', 'public');

            Media::create([
                'ref_table' => 'pembayaran_fasilitas',
                'ref_id'    => $pembayaran->bayar_id,
                'file_url'  => $path,
                'mime_type' => $request->file('resi_pembayaran')->getMimeType(),
                'caption'   => 'Resi Pembayaran',
            ]);
        }

        DB::commit();

        return redirect()
            ->route('admin.pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors($e->getMessage());
    }
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

    /* =========================
       GUEST INDEX
    ========================== */
   /* =========================================
       LOGIKA GUEST (PENGUNJUNG)
    ========================================= */

    public function guestIndex(Request $request)
    {
        // 1. Ambil daftar Metode Pembayaran unik untuk dropdown filter
        //    (Agar opsi dropdown otomatis sesuai data yang ada, misal: 'Tunai', 'Transfer')
        $listMetode = PembayaranFasilitas::select('metode')->distinct()->pluck('metode');

        // 2. Mulai Query
        $query = PembayaranFasilitas::with(['peminjaman.warga', 'peminjaman.fasilitas']);

        // 3. Logika SEARCH (Cari Nama Warga atau Nama Fasilitas)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Cari di tabel Warga (via relasi peminjaman)
                $q->whereHas('peminjaman.warga', function($w) use ($search) {
                    $w->where('nama', 'like', '%' . $search . '%');
                })
                // ATAU Cari di tabel Fasilitas (via relasi peminjaman)
                ->orWhereHas('peminjaman.fasilitas', function($f) use ($search) {
                    $f->where('nama', 'like', '%' . $search . '%');
                });
            });
        }

        // 4. Logika FILTER METODE
        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        // 5. Eksekusi Data
        $items = $query->orderBy('tanggal', 'desc')
                       ->paginate(3) // Tampilkan 9 item per halaman
                       ->withQueryString(); // Agar filter tidak reset saat pindah halaman

        return view('guest.pembayaran.index', compact('items', 'listMetode'));
    }
}
