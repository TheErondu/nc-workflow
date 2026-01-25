<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignageSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'view_type',
        'title',
        'celebrant_name',
        'birthday_date',
        'image_path',
        'active_from',
        'active_until',
        'sort_order',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'birthday_date' => 'date',
        'active_from' => 'date',
        'active_until' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active slides (for non-birthday views).
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('active_from')
                    ->orWhere('active_from', '<=', now()->toDateString());
            })
            ->where(function ($q) {
                $q->whereNull('active_until')
                    ->orWhere('active_until', '>=', now()->toDateString());
            });
    }

    /**
     * Scope to get birthday slides for today (matches month and day).
     */
    public function scopeBirthdayToday($query)
    {
        return $query->where('is_active', true)
            ->where('view_type', 'birthdays')
            ->whereMonth('birthday_date', now()->month)
            ->whereDay('birthday_date', now()->day);
    }

    /**
     * Scope to get slides for a specific view type.
     */
    public function scopeForView($query, $viewType)
    {
        return $query->where('view_type', $viewType);
    }

    /**
     * Get the full URL for the slide image.
     */
    public function getImageUrlAttribute()
    {
        return asset('uploads/signage/' . $this->image_path);
    }

    /**
     * Get the user who created this slide.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
