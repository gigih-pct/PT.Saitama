<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmdAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'week1_val', 'week1_ket', 'week1_score',
        'week2_val', 'week2_ket', 'week2_score',
        'week3_val', 'week3_ket', 'week3_score',
        'week4_val', 'week4_ket', 'week4_score',
        'week5_val', 'week5_ket', 'week5_score',
        'total_score',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
