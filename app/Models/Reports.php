<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Reports extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at'  => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
