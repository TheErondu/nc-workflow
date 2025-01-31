<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',       // Visitor's name
        'email',       // Email address
        'phone',       // Phone number
        'start',       // Start time of the appointment
        'end',         // End time of the appointment
        'status',      // Status of the appointment (pending, confirmed, cancelled)
        'description', // Additional details
        'photo',       // Photo file path
        'user_id',     // Associated user
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
