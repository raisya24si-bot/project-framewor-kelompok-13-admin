<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\PeminjamanFasilitas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ===============================
        // DONUT: Distribusi Fasilitas
        // ===============================
        $jenisList = ['Aula', 'Lapangan', 'Gedung', 'Ruang'];

        $data = FasilitasUmum::select('jenis', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis')
            ->pluck('total', 'jenis')
            ->toArray();

        $labelFasilitas = [];
        $donutFasilitas = [];

        foreach ($jenisList as $jenis) {
            $labelFasilitas[] = $jenis;
            $donutFasilitas[] = $data[$jenis] ?? 0;
        }

        // ===============================
        // TABEL: Peminjaman Terbaru
        // ===============================
        $peminjamanTerbaru = PeminjamanFasilitas::with(['warga', 'fasilitas'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'labelFasilitas',
            'donutFasilitas',
            'peminjamanTerbaru'
        ));
    }
}
