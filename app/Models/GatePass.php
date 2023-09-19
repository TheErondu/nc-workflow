<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    use HasFactory;
    protected $fillable = ['batch_id','status','items','data','return_date','user_id','department_id','for_security','print_count'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
    public function store_item()
    {
        return $this->hasMany('App\Models\Store');
    }
}
