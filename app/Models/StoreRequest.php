<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionClassConstant;

class StoreRequest extends Model
{

    use HasFactory;
    protected $fillable = ['status'];

    public const isPending    = 0;
    public const isApproved   = 1;
    public const isChecked    = 2;
    public const isReleased   = 3;
    public const isRejected   = 4;
    public const isReturned   = 5;

    static function approvalStatus()

    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants(ReflectionClassConstant::IS_PUBLIC);
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
    public function item()
    {
        return $this->hasMany('App\Models\Store', 'id');
    }
}
