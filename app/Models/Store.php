<?php

namespace App\Models;
use Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public function store_requests()
    {
        return $this->hasMany('App\Models\StoreRequest');
    }

 
}
