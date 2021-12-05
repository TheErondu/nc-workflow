<?php

namespace App\Http\Controllers\API;

use App\Models\OBlogs;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends ApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function info()
    {
        $user = Auth::user();
        $categories = [
            "1" => ["name" => "Director's Report"],
             "2" =>  ["name" => "Video Editor's Report"],
              "3" =>  ["name" =>  "OB Logs"],
               "4" =>  ["name" => "MCR Logs"],
               "5" =>  ["name" => "Production Show Logs"],
                "6" =>  ["name" => "Graphics Logs News"],
                 "7" =>  ["name" => "Graphics Logs Shows"],
                 "8" =>  ["name" => "Prompter Logs News"],
                  "9" =>  ["name" => "Prompter logs Shows"],

        ];

        return response()->json( compact('user','categories'));
    }
}
