<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'report_type',
        'content',
        'report_date',
    ];

    protected $casts = [
        'report_date' => 'date',
    ];

    public const REPORT_TYPES = [
        'director' => 'Director Logs',
        'vision_mixer' => 'Vision Mixer Logs',
        'graphics' => 'Graphics Logs',
        'sto' => 'STO Logs',
        'audio' => 'Audio Logs',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getReportTypeLabelAttribute()
    {
        return self::REPORT_TYPES[$this->report_type] ?? $this->report_type;
    }

    public function getParsedContentAttribute()
    {
        return \Illuminate\Support\Str::markdown($this->content);
    }
}
