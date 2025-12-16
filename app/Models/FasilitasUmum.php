<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';

    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'rt',
        'rw',
        'kapasitas',
        'deskripsi',
    ];

    /* =========================
       RELATIONS
    ========================== */

    public function syarat()
    {
        return $this->hasMany(SyaratFasilitas::class, 'fasilitas_id');
    }

    public function petugas()
    {
        return $this->hasMany(PetugasFasilitas::class, 'fasilitas_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'fasilitas_id')
            ->where('ref_table', 'fasilitas_umum');
    }

    /* =========================
       MEDIA HELPERS
    ========================== */

    public function foto()
    {
        return $this->media
            ->first(fn ($m) => str_starts_with($m->mime_type, 'image'));
    }

    public function sop()
    {
        return $this->media
            ->first(fn ($m) => $m->mime_type === 'application/pdf');
    }
}
