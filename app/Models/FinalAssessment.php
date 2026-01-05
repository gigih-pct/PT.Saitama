<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hiragana',
        'katakana',
        'bunpou',
        'kerja',
        'sifat',
        'benda',
        'terjemah',
        'dengar',
        'bicara',
        'sikap',
        'kehadiran',
        'rata_rata',
        'grade',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
