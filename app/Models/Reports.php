<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'log_date',
        'start',
        'end',
        'title',
        'producer',
        'anchor',
        'director',
        'camera_operator',
        'camera_operator2',
        'vision_mixer',
        'sound_technician',
        'tx',
        'graphics',
        'engineer',
        'autocue',
        'bulletins',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
