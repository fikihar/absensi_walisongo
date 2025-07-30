<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dudi extends Model
{
    use HasFactory;

    protected $table = 'dudi';

    protected $fillable = [
        'nama_dudi',
        'alamat',
        'kontak',
        'guru_id',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function penempatan()
    {
        return $this->hasMany(Penempatan::class);
    }
}
