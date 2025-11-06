<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Zakat extends Model
{
    use LogsActivity;


    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_quote',
        'hero_image',
        'what_is_title',
        'what_is_content',
        'what_is_image',
        'key_points',
        'donation_title',
        'donation_description',
        'qr_code_image',
        'donation_note',
        'nisab_gold',
        'nisab_silver',
        'is_active'
    ];

    protected $casts = [
        'key_points' => 'array',
        'nisab_gold' => 'float',
        'nisab_silver' => 'float',
        'is_active' => 'boolean'
    ];

    protected $appends = ['decoded_key_points'];

    public function getDecodedKeyPointsAttribute()
    {
        return is_string($this->key_points) ? json_decode($this->key_points, true) : $this->key_points;
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
