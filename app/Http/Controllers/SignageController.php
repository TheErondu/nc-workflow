<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Schedule;
use App\Models\Screen;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignageController extends Controller
{

    public function show(Screen $screen)
    {
        $view = request('view');


        $screenToShow = Screen::find(id: $screen->id);
        $today = Carbon::today();
        $schedules = Schedule::whereDate('start', $today)->get();
        $tickets = Issue::where('status', 'OPEN')->orderByDesc('created_at')
        ->paginate(6);
        $showreels = "";
        $data = [
            'schedules' => $schedules,
            'showreels' => $showreels,
            'tickets' => $tickets,
            'screen'   => $screenToShow
        ];
       // dd(vars: $view);
       $data['screen'] = Screen::find(3);
       $view = 'birthdays';
        if ($view != null) {
          return view(view: "dashboard.signage.$view", data: $data);
        } else {
            return view(view: "dashboard.signage.landing", data: $data);
        }
    }

    public function getScreensList()
    {
        $screens = Screen::orderBy('created_at', 'desc')->get();

        return response()->json($screens);

    }

    public function index()
    {
        $screens = Screen::orderBy('created_at', 'desc')->paginate(10);
        if (request()->wantsJson()) {
            return response()->json($screens);
        } else {

            return view('dashboard.signage.admin.index', compact('screens'));
        }
    }

    public function createScreen(Request $request): \Illuminate\Http\RedirectResponse
    {
        $views = implode(",", $request->input('views'));
        $screen = Screen::create([
            'name' => $request->input('name'),
            'views' => $views
        ]);

        return redirect()->route('signage.admin', $screen->id)->with('message', 'New screens added!');

    }

    public function showCreateScreenPage()
    {
        $views = [
            "showreels",
            "tickets",
            "today",
            "birthdays"
        ];

        return view('dashboard.signage.admin.screens.create', compact('views'));
    }

}
