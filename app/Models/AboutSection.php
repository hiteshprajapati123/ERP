<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutSection extends Model
{
    use LogsActivity;


    use HasFactory;
        
    protected $fillable = [
        'title',
        'description',
        'welcome_title',
        'welcome_content',
        'image',
        'quote_1_text',
        'quote_1_author',
        'quote_2_text',
        'quote_2_author',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
