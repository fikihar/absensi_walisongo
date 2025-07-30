<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'penempatan_id',
        'tanggal',
        'jenis',
        'alasan',
        'waktu',
    ];

    /**
     * Relasi ke model Penempatan
     */
    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class);
    }
}
