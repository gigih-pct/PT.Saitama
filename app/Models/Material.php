<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensei_id',
        'kelas_id',
        'subject',
        'title',
        'level',
        'file_path',
    ];

    public function sensei()
    {
        return $this->belongsTo(User::class, 'sensei_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
