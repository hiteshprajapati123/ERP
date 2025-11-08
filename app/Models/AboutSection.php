<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutSection extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'title',
        'description',
        'welcome_title',
        'welcome_content',
        'image',
        'quote_1_text',
        'quote_1_author',
        'quote_2_text',
        'quote_2_author',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get a public URL for the about section image.
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('images/placeholder.jpg');
        }

        // already a full URL
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Private disk path check
        $filename = basename($this->image);
        if (\Illuminate\Support\Facades\Storage::disk('private')->exists('about(homepage)/' . $filename)) {
            return route('about-section.image', ['filename' => $filename]);
        }

        // Fallback to public storage if present
        $publicPath = 'storage/' . ltrim($this->image, '/');
        if (file_exists(public_path($publicPath))) {
            return asset($publicPath);
        }

        \Log::warning('AboutSection image not found', [
            'image' => $this->image,
            'checked' => [
                storage_path('app/private/about(homepage)/' . $filename),
                public_path($publicPath),
            ],
        ]);

        return asset('images/placeholder.jpg');
    }
}
