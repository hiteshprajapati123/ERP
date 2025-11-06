<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendance;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'activity_type',
        'description',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    // Activity types
    const TYPE_CREATED = 'created';
    const TYPE_UPDATED = 'updated';
    const TYPE_DELETED = 'deleted';
    const TYPE_VIEWED = 'viewed';
    const TYPE_LOGGED_IN = 'logged_in';
    const TYPE_LOGGED_OUT = 'logged_out';
    const TYPE_PAID = 'paid';
    const TYPE_DOWNLOADED = 'downloaded';

    // Model types
    const MODEL_RESULT = 'App\\Models\\ExamResult';
    const MODEL_ATTENDANCE = 'App\\Models\\Attendance';
    const MODEL_FEE = 'App\\Models\\Fee';
    const MODEL_NOTICE = 'App\\Models\\UserNotice';
    const MODEL_PROFILE = 'App\\Models\\User';

    /**
     * Get the user that owns the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get the related fee for this activity
     */
    public function fee()
    {
        return $this->belongsTo(\App\Models\Fee::class, 'model_id')
            ->withDefault(); // Return an empty Fee model if not found
    }
    
    /**
     * Scope a query to only include fee activities
     */
    public function scopeFeeActivities($query)
    {
        return $query->where('model_type', self::MODEL_FEE)
                    ->with(['user', 'fee'])
                    ->latest();
    }

    /** 
     * Get the related model instance.
     */
    public function model()
    {
        if ($this->model_type === self::MODEL_ATTENDANCE || $this->model_type === 'App\\Models\\Attendance') {
            return $this->belongsTo(Attendance::class, 'model_id');
        } elseif ($this->model_type === self::MODEL_PROFILE || $this->model_type === 'App\\Models\\User') {
            return $this->belongsTo(User::class, 'model_id');
        } elseif ($this->model_type === self::MODEL_FEE || $this->model_type === 'App\\Models\\Fee') {
            return $this->belongsTo(\App\Models\Fee::class, 'model_id');
        }
        return $this->morphTo('model', 'model_type', 'model_id');
    }
    
    /**
     * Get the attendance record associated with this activity.
     */
    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'model_id');
    }
    
    /**
     * Create a new activity log entry.
     */
    public static function log(
        $userId,
        $activityType,
        $description,
        $modelType = null,
        $modelId = null,
        $oldValues = null,
        $newValues = null
    ) {
        return self::create([
            'user_id' => $userId,
            'activity_type' => $activityType,
            'description' => $description,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
