<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    /**
     * Available view types for signage screens.
     */
    public const VIEW_TYPES = [
        'showreels',
        'tickets',
        'today',
        'birthdays',
        'general',
    ];

    protected $fillable = [
        'name',
        'views',
        'slide_duration',
        'view_duration',
    ];

    protected $casts = [
        'views' => 'array',
    ];
}
