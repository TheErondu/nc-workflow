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
        $message = "Authenticated";

        return response()->json( compact('user','message'));
    }
}
