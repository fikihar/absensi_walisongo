<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlokasiGuru extends Model
{
     protected $fillable = ['guru_id', 'dudi_id'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
}
