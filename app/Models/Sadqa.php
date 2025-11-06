<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sadqa extends Model
{
    use HasFactory;

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

    public function getHeroImageUrlAttribute()
    {
        return $this->hero_image ? Storage::url($this->hero_image) : asset('images/default-hero.jpg');
    }

    public function getWhatIsImageUrlAttribute()
    {
        return $this->what_is_image ? Storage::url($this->what_is_image) : asset('images/default-what-is.jpg');
    }

    public function getQrCodeImageUrlAttribute()
    {
        return $this->qr_code_image ? Storage::url($this->qr_code_image) : asset('images/default-qr.png');
    }
}
