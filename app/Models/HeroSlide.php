<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'order',
        'is_active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the URL for the hero slide image.
     *
     * @return string
     */
    /**
     * Get the URL for the hero slide image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        // Check if the image is in private storage
        $privatePath = 'app/private/hero_slides/' . basename($this->image);
        if (file_exists(storage_path($privatePath))) {
            return route('hero-slide.image', ['filename' => basename($this->image)]);
        }
        
        // Check if the image is in public storage
        $publicPath = 'storage/hero_slides/' . basename($this->image);
        if (file_exists(public_path($publicPath))) {
            return asset($publicPath);
        }
        
        // Check if the image path is already a full URL
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        
        // Log the missing image for debugging
        \Log::warning('Hero slide image not found', [
            'image_path' => $this->image,
            'tried_paths' => [
                storage_path($privatePath),
                public_path($publicPath)
            ]
        ]);
        
        // Return a placeholder if no image is found
        return asset('images/placeholder.jpg');
    }
    
    /**
     * Get the URL for the hero slide image (for internal use).
     *
     * @return string
     */
    public function getImagePath()
    {
        $privatePath = 'app/private/hero_slides/' . basename($this->image);
        if (file_exists(storage_path($privatePath))) {
            return storage_path($privatePath);
        }
        
        $publicPath = 'storage/hero_slides/' . basename($this->image);
        if (file_exists(public_path($publicPath))) {
            return public_path($publicPath);
        }
        
        return null;
    }
}
