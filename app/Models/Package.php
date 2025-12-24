<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'departure_date' => 'date',
        'return_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->name);
            }
        });
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(PackageFacility::class)->orderBy('order');
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(PackageItinerary::class)->orderBy('day');
    }
}
