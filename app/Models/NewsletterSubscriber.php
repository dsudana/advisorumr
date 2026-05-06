<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'interests',
        'is_confirmed',
        'confirmed_at',
        'unsubscribed_at',
        'unsubscribe_token',
        'email_count',
        'open_count',
        'click_count',
        'last_emailed_at',
        'last_opened_at',
        'last_clicked_at',
    ];

    protected $casts = [
        'interests' => 'array',
        'is_confirmed' => 'boolean',
        'confirmed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
        'last_emailed_at' => 'datetime',
        'last_opened_at' => 'datetime',
        'last_clicked_at' => 'datetime',
        'email_count' => 'integer',
        'open_count' => 'integer',
        'click_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->unsubscribe_token)) {
                $subscriber->unsubscribe_token = Str::random(32);
            }
        });
    }

    public function scopeConfirmed($query)
    {
        return $query->where('is_confirmed', true)
            ->whereNull('unsubscribed_at');
    }

    public function scopeUnsubscribed($query)
    {
        return $query->whereNotNull('unsubscribed_at');
    }

    public function unsubscribe(): void
    {
        $this->update([
            'unsubscribed_at' => now(),
        ]);
    }

    public function confirm(): void
    {
        $this->update([
            'is_confirmed' => true,
            'confirmed_at' => now(),
        ]);
    }

    public function trackEmailSent(): void
    {
        $this->increment('email_count');
        $this->update(['last_emailed_at' => now()]);
    }

    public function trackOpen(): void
    {
        $this->increment('open_count');
        $this->update(['last_opened_at' => now()]);
    }

    public function trackClick(): void
    {
        $this->increment('click_count');
        $this->update(['last_clicked_at' => now()]);
    }

    public function getFullNameAttribute(): ?string
    {
        if ($this->first_name || $this->last_name) {
            return trim("{$this->first_name} {$this->last_name}");
        }
        return null;
    }
}
