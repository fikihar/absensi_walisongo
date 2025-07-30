<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlokasiSiswa extends Model
{
    protected $fillable = ['siswa_id', 'dudi_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
