<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nama',
        'nis',
        'kelas',
        'jenis_kelamin',
        'email',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function penempatan()
    {
        return $this->hasOne(Penempatan::class);
    }
}
