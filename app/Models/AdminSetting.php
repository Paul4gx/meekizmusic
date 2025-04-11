<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'contact_info',
        'next_beat_release',
        'quick_search'
    ];

    protected $casts = [
        'contact_info' => 'array',
        'quick_search' => 'array',
        'next_beat_release' => 'datetime'
    ];
} 