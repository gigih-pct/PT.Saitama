<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WawancaraAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program',
        'umum',
        'jepang',
        'indo',
        'sum',
        'percent',
        'note',
        'cara_duduk',
        'suara',
        'fokus',
        'sum_sikap',
        'percent_sikap',
        'note_sikap',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
