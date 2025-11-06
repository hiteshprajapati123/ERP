<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address',
        'phone1',
        'phone2',
        'email1',
        'email2',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
