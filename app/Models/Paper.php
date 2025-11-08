<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'year',
        'term',
        'file_path'
    ];

    protected $casts = [
        'year' => 'integer',
    ];
}
