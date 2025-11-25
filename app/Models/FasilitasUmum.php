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
        return $this->hasMany(Media::class, 'ref_id')
                    ->where('ref_table', 'fasilitas_umum');
    }
}
