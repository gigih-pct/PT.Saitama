<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelases';

    protected $fillable = [
        'nama_kelas',
        'kapasitas',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'kelas_id');
    }
}
