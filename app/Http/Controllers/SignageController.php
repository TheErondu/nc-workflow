<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignageController extends Controller
{

    public function show()
    {
        $display = request()->get('display') ?? 'showreels';
        $today = Carbon::today();
        $schedules = Schedule::whereDate('start', $today)
        ->paginate(6);
        $showreels = "";
        $data = [
            'schedules' => $schedules,
            'showreels' => $showreels
        ];
        $view = 'dashboard.signage.'.$display;
        return view($view, $data);
    }
}
