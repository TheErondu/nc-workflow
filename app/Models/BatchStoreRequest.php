<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchStoreRequest extends Model
{
    use HasFactory;
    protected $fillable = ['status'];
    protected $table = 'batch_store_requests';
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
