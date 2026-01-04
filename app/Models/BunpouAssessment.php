<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BunpouAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'eval1',
        'eval2',
        'eval3',
        'eval4',
        'eval5',
        'eval6',
        'eval1_at',
        'eval2_at',
        'eval3_at',
        'eval4_at',
        'eval5_at',
        'eval6_at',
        'final_ujian',
        'final_nilai',
        'final_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
