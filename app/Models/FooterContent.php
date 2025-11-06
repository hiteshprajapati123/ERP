<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'footer_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section',
        'content',
        'address',
        'phone',
        'email',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active about section content
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function getAboutSection()
    {
        return static::where('section', 'about')
                    ->where('is_active', true)
                    ->first();
    }

    /**
     * Get the active contact section content
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function getContactSection()
    {
        return static::where('section', 'contact')
                    ->where('is_active', true)
                    ->first();
    }
}
