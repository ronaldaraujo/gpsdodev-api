<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BussolaSubmission extends Model
{
    protected $fillable = [
        'token',
        'answers',
        'scores',
        'profile',
        'strengths',
        'growth_areas',
        'user_agent',
        'report_request_id',
    ];

    protected $casts = [
        'answers' => 'array',
        'scores' => 'array',
        'profile' => 'array',
        'strengths' => 'array',
        'growth_areas' => 'array',
    ];

    public function reportRequest(): BelongsTo
    {
        return $this->belongsTo(ReportRequest::class);
    }
}
