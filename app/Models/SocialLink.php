<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'platform',
        'icon_class',
        'url',
        'sort_order',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get all active social links ordered by sort_order
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getActiveLinks()
    {
        return static::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
    }
}
