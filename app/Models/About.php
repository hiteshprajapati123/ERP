<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Support\Facades\Storage;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'intro_content',
        'vision',
        'mission',
        'history_content',
        'what_we_offer',
        'highlights',
        'programs',
        'principal_message',
        'contact_address',
        'contact_phone',
        'contact_email',
        'is_active',
        // meta_title, meta_description, meta_keywords removed
    ];

    protected $casts = [
        'what_we_offer' => 'array',
        'highlights' => 'array',
        'programs' => 'array',
        'is_active' => 'boolean'
    ];

    // protected $appends = [
    // ];

    // banner image removed

    public function getDecodedWhatWeOfferAttribute()
    {
        return is_string($this->what_we_offer) ? json_decode($this->what_we_offer, true) : $this->what_we_offer;
    }

    public function getDecodedHighlightsAttribute()
    {
        return is_string($this->highlights) ? json_decode($this->highlights, true) : $this->highlights;
    }

    public function getDecodedProgramsAttribute()
    {
        return is_string($this->programs) ? json_decode($this->programs, true) : $this->programs;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
