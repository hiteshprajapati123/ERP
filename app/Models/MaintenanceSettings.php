<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceSettings extends Model
{
    protected $fillable = [
        'is_enabled',
        'title',
        'message',
        'estimated_time',
        'starts_at',
        'ends_at',
        'contact_email',
        'contact_phone',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
}
