<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranFasilitas extends Model
{
    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';

    protected $fillable = [
        'pinjam_id',
        'tanggal',
        'jumlah',
        'metode',
        'keterangan',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id');
    }

    //relasi bukti bayar
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'pembayaran_fasilitas');
    }

    //ambil bukti pertama
    public function bukti()
    {
        return $this->media()->first();
    }

    //format rupiah
    public function getJumlahFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}
