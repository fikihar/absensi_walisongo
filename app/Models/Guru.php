<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'email',
        'no_telp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dudi()
    {
        return $this->hasMany(Dudi::class);
    }
    public function penempatan()
    {
        return $this->hasMany(Penempatan::class);
    }
}
