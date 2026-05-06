<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversionEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'user_id',
        'booking_id',
        'event_type',
        'event_category',
        'event_name',
        'page_url',
        'page_title',
        'referrer_url',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'device_type',
        'browser',
        'os',
        'ip_address',
        'value',
        'currency',
        'properties',
        'session_id',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'properties' => 'array',
    ];

    // Common event types
    const EVENT_PAGE_VIEW = 'page_view';
    const EVENT_FORM_SUBMIT = 'form_submit';
    const EVENT_LEAD_CAPTURE = 'lead_capture';
    const EVENT_NEWSLETTER_SIGNUP = 'newsletter_signup';
    const EVENT_ADD_TO_CART = 'add_to_cart';
    const EVENT_CHECKOUT_START = 'checkout_start';
    const EVENT_PAYMENT_INITIATED = 'payment_initiated';
    const EVENT_PAYMENT_COMPLETE = 'payment_complete';
    const EVENT_BOOKING_INITIATED = 'booking_initiated';
    const EVENT_BOOKING_COMPLETE = 'booking_complete';
    const EVENT_WHATSAPP_CLICK = 'whatsapp_click';
    const EVENT_PHONE_CLICK = 'phone_click';
    const EVENT_DOWNLOAD = 'download';
    const EVENT_VIDEO_PLAY = 'video_play';
    const EVENT_EMAIL_OPENED = 'email_opened';
    const EVENT_EMAIL_CLICKED = 'email_clicked';

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function scopeEventType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeBySession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    public function scopeWithValue($query)
    {
        return $query->whereNotNull('value');
    }

    public static function track(
        string $eventType,
        string $eventName,
        array $data = []
    ): self {
        return static::create(array_merge([
            'event_type' => $eventType,
            'event_name' => $eventName,
            'event_category' => 'general',
        ], $data));
    }
}
