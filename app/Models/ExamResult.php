<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class ExamResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'exam_name',
        'date',
        'obtained_marks',
        'total_marks',
        'grade',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'obtained_marks' => 'float',
        'total_marks' => 'float',
    ];
    
    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = ['percentage'];

    /**
     * Get the user that owns the exam result.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the calculated percentage attribute.
     *
     * @return float
     */
    public function getPercentageAttribute(): float
    {
        if ($this->total_marks <= 0) return 0;
        return round(($this->obtained_marks / $this->total_marks) * 100, 2);
    }

    /**
     * Calculate grade based on percentage.
     *
     * @param  float  $percentage
     * @return string
     */
    public static function calculateGrade(float $percentage): string
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 60) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }
}
