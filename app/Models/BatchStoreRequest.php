<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchStoreRequest extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'location_id'];
    protected $table = 'batch_store_requests';

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }
}
