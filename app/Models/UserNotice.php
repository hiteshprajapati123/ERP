<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotice extends Model
{
    use LogsActivity;


    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'slug',
        'content',
        'image_path',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'publish_date',
        'expiry_date',
        'is_pinned',
        'is_important',
        'is_published',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publish_date' => 'date',
        'expiry_date' => 'date',
        'is_pinned' => 'boolean',
        'is_important' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Get the user who created the notice.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include published notices.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->where('publish_date', '<=', now())
                    ->where(function($q) {
                        $q->whereNull('expiry_date')
                          ->orWhere('expiry_date', '>=', now());
                    });
    }

    /**
     * Scope a query to only include pinned notices.
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope a query to only include important notices.
     */
    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }

    /**
     * Get the URL to the notice's image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    /**
     * Get the URL to the notice's file.
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }
    
    /**
     * Get the color associated with the notice type.
     *
     * @return string
     */
    public function getTypeColorAttribute()
    {
        $colors = [
            'general' => '#4e73df', // Blue
            'academic' => '#1cc88a', // Green
            'exam' => '#e74a3b', // Red
            'event' => '#f6c23e', // Yellow
            'alert' => '#e74a3b', // Red
        ];
        
        return $colors[$this->type] ?? '#6c757d'; // Default gray
    }
    
    /**
     * Get all distinct notice types from the database
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getNoticeTypes()
    {
        return static::select('type')
            ->distinct()
            ->whereNotNull('type')
            ->pluck('type')
            ->mapWithKeys(function ($type) {
                return [
                    $type => [
                        'name' => ucfirst($type),
                        'color' => (new static(['type' => $type]))->type_color
                    ]
                ];
            });
    }
}
