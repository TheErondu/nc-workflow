<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signage extends Model
{
    use HasFactory;
    public function screens()
    {
        return $this->hasMany(Screen::class);
    }


}
