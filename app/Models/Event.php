<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'event_date',
        'start_time',
        'end_time',
        'location',
        'address',
        'is_featured',
        'registration_required',
        'max_attendees',
        'slug'
    ];

    /**
     * Get the route key name for Laravel's route model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'title';
    }

    protected $casts = [
        'event_date' => 'datetime',
        'is_featured' => 'boolean',
        'registration_required' => 'boolean',
        'event_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
    
    /**
     * Scope a query to only include featured events.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
    
    /**
     * Scope a query to only include past events.
     */
    public function scopePast($query)
    {
        return $query->where('event_date', '<', now())
                    ->orderBy('event_date', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = Str::slug($event->title);
            }
        });
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now())
                    ->orderBy('event_date', 'asc');
    }

}
