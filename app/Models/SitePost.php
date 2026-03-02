<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitePost extends Model
{
    protected $fillable = [
        'title',
        'url',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'date',
    ];
}
