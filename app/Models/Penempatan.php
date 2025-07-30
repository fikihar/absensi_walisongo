<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penempatan extends Model
{
    use HasFactory;

    protected $table = 'penempatan';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'dudi_id',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    /**
     * Relasi ke model Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Relasi ke model Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /**
     * Relasi ke model Dudi
     */
    public function dudi()
    {
        return $this->belongsTo(Dudi::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
