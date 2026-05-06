<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'type',
        'subject',
        'content',
        'channel',
        'occurred_at',
        'duration_seconds',
        'follow_up_date',
        'follow_up_notes',
        'follow_up_completed',
        'metadata',
    ];

    protected $casts = [
        'occurred_at' => 'datetime',
        'follow_up_date' => 'datetime',
        'follow_up_completed' => 'boolean',
        'metadata' => 'array',
        'duration_seconds' => 'integer',
    ];

    const TYPE_CALL = 'call';
    const TYPE_EMAIL = 'email';
    const TYPE_WHATSAPP = 'whatsapp';
    const TYPE_SMS = 'sms';
    const TYPE_MEETING = 'meeting';
    const TYPE_NOTE = 'note';
    const TYPE_FORM_SUBMISSION = 'form_submission';
    const TYPE_WEBSITE_VISIT = 'website_visit';

    public static function getTypes(): array
    {
        return [
            self::TYPE_CALL => 'Phone Call',
            self::TYPE_EMAIL => 'Email',
            self::TYPE_WHATSAPP => 'WhatsApp',
            self::TYPE_SMS => 'SMS',
            self::TYPE_MEETING => 'Meeting',
            self::TYPE_NOTE => 'Note',
            self::TYPE_FORM_SUBMISSION => 'Form Submission',
            self::TYPE_WEBSITE_VISIT => 'Website Visit',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeNeedsFollowUp($query)
    {
        return $query->whereNotNull('follow_up_date')
            ->where('follow_up_completed', false)
            ->where('follow_up_date', '<=', now());
    }

    public function markFollowUpCompleted(): void
    {
        $this->update(['follow_up_completed' => true]);
    }
}
