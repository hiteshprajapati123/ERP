<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'month_year',
        'description',
        'amount',
        'due_date',
        'status',
        'paid_date',
        'transaction_id',
        'payment_details'
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_date' => 'date',
        'amount' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
