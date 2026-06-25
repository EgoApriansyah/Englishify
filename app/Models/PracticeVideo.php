<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'youtube_id',
        'category',
        'difficulty',
        'duration',
        'description',
        'transcript_data',
    ];

    protected $casts = [
        'transcript_data' => 'array',
    ];
}
