<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'introduction',
        'sections',
        'info_we_collect',
        'how_we_use',
        'data_protection',
        'your_rights',
        'updates_to_policy',
        'last_updated',
        'last_updated_date',
        'is_active'
    ];

    protected $casts = [
        'sections' => 'array',
        'last_updated_date' => 'date',
        'is_active' => 'boolean'
    ];
}
