<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'scores',
        'profile',
        'strengths',
        'growth_areas',
        'status',
    ];

    protected $casts = [
        'scores' => 'array',
        'profile' => 'array',
        'strengths' => 'array',
        'growth_areas' => 'array',
    ];
}
