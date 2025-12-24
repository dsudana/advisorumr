<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'video_url',
        'activity_date',
        'is_published',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'is_published' => 'boolean',
    ];
}
