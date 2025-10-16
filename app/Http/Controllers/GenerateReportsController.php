<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreRequest;

class GenerateReportsController extends Controller
{
    public function index() {
        $module = [
            "Store Items" => Store::class,
            "Item Requests" => StoreRequest::class
        ];
        $item_states = Store::getConstants();
        return view('dashboard.reports.generate.index',compact('module','item_states'));
    }
}
