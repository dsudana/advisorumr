<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'logo_path',
        'favicon_path',
        'contact_phone',
        'contact_email',
        'address',
        'google_maps_embed',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'twitter_url',
        'youtube_url',
    ];

    protected $casts = [
        'site_description' => 'string',
    ];
}
