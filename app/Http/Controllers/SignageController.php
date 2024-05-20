<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignageController extends Controller
{

    public function show()
    {
        $display = request()->get('display') ?? 'showreels';
        $today = Carbon::today();
        $schedules = Schedule::whereDate('start', $today)->get();
        $tickets = Issue::where('status', 'OPEN')->orderByDesc('created_at')
        ->paginate(6);
        $showreels = "";
        $data = [
            'schedules' => $schedules,
            'showreels' => $showreels,
            'tickets' => $tickets
        ];
        $view = 'dashboard.signage.'.$display;
        return view($view, $data);
    }

    public function index()
    {
        

        return view('dashboard.signage.admin.index');
    }

}
