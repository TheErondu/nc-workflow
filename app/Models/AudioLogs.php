<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioLogs extends Model
{
    use HasFactory;

    protected $table = 'audio_logs';

    protected $fillable = [
        'sto', 'timing', 'programmes', 'remarks', 'squeezbacks',
        'tc', 'traffic', 'handed_over_to', 'user_id', 'title',
        'start', 'end', 'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
