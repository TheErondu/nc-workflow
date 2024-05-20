<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;
    protected $fillable = ['name','views'];

    public function signage()
    {
        return $this->belongsTo(Signage::class);
    }
}
