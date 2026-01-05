<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'month',
        'year',
        'status',
        'phone',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
