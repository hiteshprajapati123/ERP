<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Fitraa extends Model
{
    protected $table = 'fitraa';

    protected $fillable = [
        'hero_title',
        'hero_quote',
        'hero_image',
        'what_is_title',
        'what_is_content',
        'what_is_image',
        'benefits',
        'donation_title',
        'donation_description',
        'qr_code_image',
        'donation_note',
        'is_active'
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_active' => 'boolean'
    ];

    protected $appends = ['decoded_benefits'];

    public function getDecodedBenefitsAttribute()
    {
        return is_string($this->benefits) ? json_decode($this->benefits, true) : $this->benefits;
    }

    /**
     * Get the URL for the hero image.
     */
    public function getHeroImageUrlAttribute()
    {
        return $this->hero_image ? Storage::url($this->hero_image) : asset('images/default-hero.jpg');
    }

    /**
     * Get the URL for the what is image.
     */
    public function getWhatIsImageUrlAttribute()
    {
        return $this->what_is_image ? Storage::url($this->what_is_image) : asset('images/default-what-is.jpg');
    }

    /**
     * Get the URL for the QR code image.
     */
    public function getQrCodeImageUrlAttribute()
    {
        return $this->qr_code_image ? Storage::url($this->qr_code_image) : asset('images/default-qr.png');
    }
}
