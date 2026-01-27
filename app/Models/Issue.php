<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'date',
        'location',
        'raised_by',
        'department',
        'status',
        'fixed_by',
        'assigned_engineer',
        'action_taken',
        'cause_of_breakdown',
        'engineers_comment',
        'resolved_date',
    ];

    protected $casts = [
        'date' => 'datetime',
        'resolved_date' => 'datetime',
    ];

    public const STATUSES = [
        'OPEN' => 'Open',
        'CLOSED' => 'Closed',
    ];

    /**
     * Get the user who raised the issue by name lookup
     */
    public function raisedByUser()
    {
        return $this->belongsTo(User::class, 'raised_by', 'name');
    }

    /**
     * Get the user who fixed the issue
     */
    public function fixedByUser()
    {
        return $this->belongsTo(User::class, 'fixed_by', 'name');
    }

    /**
     * Get the assigned engineer
     */
    public function assignedEngineerUser()
    {
        return $this->belongsTo(User::class, 'assigned_engineer', 'name');
    }
}
