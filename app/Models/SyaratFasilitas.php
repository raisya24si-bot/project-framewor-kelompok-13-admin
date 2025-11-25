<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratFasilitas extends Model
{
    protected $table = 'syarat_fasilitas';
    protected $primaryKey = 'syarat_id';

    protected $fillable = [
        'fasilitas_id',
        'nama_syarat',
        'deskripsi',
    ];

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id');
    }
}
