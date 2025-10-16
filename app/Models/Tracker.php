<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Tracker extends Model
{
    use HasFactory;

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
