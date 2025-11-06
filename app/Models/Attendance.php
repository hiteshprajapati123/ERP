<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Attendance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'status',
        'notes',
        'holiday_status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'holiday_status' => 'boolean'
    ];

    /**
     * The possible status values.
     *
     * @var array
     */
    public static $statuses = [
        'present' => 'Present',
        'absent' => 'Absent',
        'holiday' => 'Holiday'
    ];

    /**
     * Get the user that owns the attendance record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include records for a specific month and year.
     */
    public function scopeForMonth($query, $month, $year)
    {
        return $query->whereMonth('date', $month)
                    ->whereYear('date', $year);
    }

    /**
     * Calculate working hours based on check-in and check-out times.
     */
    public function calculateWorkingHours(): void
    {
        if ($this->check_in && $this->check_out) {
            $checkIn = Carbon::parse($this->check_in);
            $checkOut = Carbon::parse($this->check_out);
            $this->working_hours = round($checkOut->diffInMinutes($checkIn) / 60, 2);
        }
    }

    /**
     * Get the status with proper formatting.
     */
    public function getFormattedStatusAttribute(): string
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}
