<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Reports extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
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
