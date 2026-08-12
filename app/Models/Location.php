<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address'];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function storeRequests()
    {
        return $this->hasMany(StoreRequest::class);
    }

    public function batchStoreRequests()
    {
        return $this->hasMany(BatchStoreRequest::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
