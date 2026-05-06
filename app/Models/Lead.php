<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lead_source_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'whatsapp_number',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'referrer_url',
        'landing_page',
        'device_type',
        'browser',
        'os',
        'ip_address',
        'package_id',
        'preferred_travel_date',
        'number_of_passengers',
        'estimated_budget',
        'status',
        'priority',
        'notes',
        'converted_at',
    ];

    protected $casts = [
        'preferred_travel_date' => 'date',
        'estimated_budget' => 'decimal:2',
        'number_of_passengers' => 'integer',
        'converted_at' => 'datetime',
    ];

    const STATUS_NEW = 'new';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_QUALIFIED = 'qualified';
    const STATUS_PROPOSAL_SENT = 'proposal_sent';
    const STATUS_NEGOTIATION = 'negotiation';
    const STATUS_CONVERTED = 'converted';
    const STATUS_LOST = 'lost';

    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_CONTACTED => 'Contacted',
            self::STATUS_QUALIFIED => 'Qualified',
            self::STATUS_PROPOSAL_SENT => 'Proposal Sent',
            self::STATUS_NEGOTIATION => 'Negotiation',
            self::STATUS_CONVERTED => 'Converted',
            self::STATUS_LOST => 'Lost',
        ];
    }

    public static function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW => 'Low',
            self::PRIORITY_MEDIUM => 'Medium',
            self::PRIORITY_HIGH => 'High',
            self::PRIORITY_URGENT => 'Urgent',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(LeadInteraction::class);
    }

    public function conversionEvents(): HasMany
    {
        return $this->hasMany(ConversionEvent::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function isConverted(): bool
    {
        return $this->status === self::STATUS_CONVERTED;
    }

    public function markAsConverted(): void
    {
        $this->update([
            'status' => self::STATUS_CONVERTED,
            'converted_at' => now(),
        ]);
    }

    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeQualified($query)
    {
        return $query->where('status', self::STATUS_QUALIFIED);
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', [self::PRIORITY_HIGH, self::PRIORITY_URGENT]);
    }

    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
