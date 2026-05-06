<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadSource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public static function getDefaultSources(): array
    {
        return [
            ['name' => 'organic', 'description' => 'Organic search traffic'],
            ['name' => 'paid_ads', 'description' => 'Paid advertising (Google Ads, Facebook Ads)'],
            ['name' => 'social_media', 'description' => 'Social media platforms'],
            ['name' => 'referral', 'description' => 'Referral from other websites'],
            ['name' => 'direct', 'description' => 'Direct traffic'],
            ['name' => 'email_campaign', 'description' => 'Email marketing campaigns'],
            ['name' => 'whatsapp', 'description' => 'WhatsApp referrals'],
            ['name' => 'offline', 'description' => 'Offline sources (events, word of mouth)'],
        ];
    }
}
