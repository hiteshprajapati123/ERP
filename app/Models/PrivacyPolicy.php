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
        'last_updated',
        'is_active'
    ];

    protected $casts = [
        'sections' => 'array',
        'is_active' => 'boolean'
    ];
}
