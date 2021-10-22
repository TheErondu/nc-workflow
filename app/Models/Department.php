<?php

namespace App\Models;
use Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function hod()
    {
        return $this->belongsTo('App\Models\User','user_id' );
    }
    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-M-Y');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-M-Y');
    }
}
