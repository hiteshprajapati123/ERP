<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'notice_date',
        'expiry_date',
        'is_published',
        'file_path',
        'image_path',
        'file_name',
        'file_size',
        'file_type',
        'contact_person',
        'contact_email',
        'contact_phone',
        'location',
        'event_date'
    ];

    protected $casts = [
        'notice_date' => 'date',
        'expiry_date' => 'date',
        'event_date' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where(function($q) {
                        $q->whereNull('expiry_date')
                          ->orWhere('expiry_date', '>=', now());
                    });
    }

    public function scopeRecent($query, $limit = 5)
    {
        return $query->published()
                    ->orderBy('notice_date', 'desc')
                    ->limit($limit);
    }

    public function getFileSizeAttribute($value)
    {
        if ($value >= 1073741824) {
            return number_format($value / 1073741824, 2) . ' GB';
        } elseif ($value >= 1048576) {
            return number_format($value / 1048576, 2) . ' MB';
        } elseif ($value >= 1024) {
            return number_format($value / 1024, 2) . ' KB';
        }

        return $value . ' bytes';
    }
}