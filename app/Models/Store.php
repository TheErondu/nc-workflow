<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use ReflectionClassConstant;

class Store extends Model
{
    //Constants for items
    public const unknown = -1;
    public const is_new_item = 0;
    public const is_in_circulation = 1;
    public const is_borrowed = 2;
    public const is_under_repair = 3;
    public const is_out_of_order = 4;
    public const is_newly_verified = 5;


    static function statuses()
    {
        return
            [
                'pending',
                'approved',
                'checked',
                'released',
                'returned'
            ];
    }

    static function getConstants()
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants(ReflectionClassConstant::IS_PUBLIC);
    }



    use HasFactory;
    protected $fillable = ['asset_class', 'barcode_id', 'inventory_number', 'status', 'class_description', 'serial_no', 'asset_description', 'location', 'sub_location', 'qty'];
    public function store_requests()
    {
        return $this->hasMany('App\Models\StoreRequest');
    }
    public function batch_store_requests()
    {
        return $this->hasMany('App\Models\StoreRequest');
    }
    public function gatepass()
    {
        return $this->belongsTo('App\Models\Gatepass');
    }
}
