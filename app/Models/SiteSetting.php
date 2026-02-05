<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_name_primary',
        'school_name_secondary',
        'logo_path',
    ];

    /**
     * Get the first (current) site settings record.
     */
    public static function current(): ?self
    {
        return static::query()->first();
    }
}

