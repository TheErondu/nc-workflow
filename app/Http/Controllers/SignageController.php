<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Schedule;
use App\Models\Screen;
use App\Models\SignageSlide;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignageController extends Controller
{
    /**
     * Display a signage view for a screen.
     */
    public function show(Screen $screen)
    {
        $view = request('view');

        $screenToShow = Screen::find($screen->id);
        $today = Carbon::today();
        $schedules = Schedule::whereDate('start', $today)->get();
        $tickets = Issue::where('status', 'OPEN')->orderByDesc('created_at')
            ->take(20)
            ->get();

        // Fetch slides only for image-based views (not HTML views like tickets/today)
        $slides = [];
        if ($view === 'birthdays') {
            // Birthday slides: only show celebrants whose birthday is TODAY
            $slides = SignageSlide::birthdayToday()
                ->orderBy('sort_order')
                ->get();
        } elseif (in_array($view, ['showreels', 'general'])) {
            // Other image-based slides: use active date range
            $slides = SignageSlide::active()
                ->forView($view)
                ->orderBy('sort_order')
                ->get();
        }

        $showreels = "";
        $data = [
            'schedules' => $schedules,
            'showreels' => $showreels,
            'tickets' => $tickets,
            'screen' => $screenToShow,
            'slides' => $slides,
        ];

        if ($view != null) {
            return view("dashboard.signage.$view", $data);
        } else {
            return view("dashboard.signage.landing", $data);
        }
    }

    /**
     * Get list of screens as JSON.
     */
    public function getScreensList()
    {
        $screens = Screen::orderBy('created_at', 'desc')->get();

        return response()->json($screens);
    }

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $screens = Screen::orderBy('created_at', 'desc')->paginate(10);
        if (request()->wantsJson()) {
            return response()->json($screens);
        }

        return view('dashboard.signage.admin.index', compact('screens'));
    }

    /**
     * Show the form for creating a new screen.
     */
    public function showCreateScreenPage()
    {
        $views = Screen::VIEW_TYPES;

        return view('dashboard.signage.admin.screens.create', compact('views'));
    }

    /**
     * Store a newly created screen.
     */
    public function createScreen(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:screens,name',
            'views' => 'required|array|min:1',
            'views.*' => 'in:' . implode(',', Screen::VIEW_TYPES),
            'slide_duration' => 'nullable|integer|min:1000|max:60000',
            'view_duration' => 'nullable|integer|min:10000|max:600000',
        ]);

        Screen::create([
            'name' => $validated['name'],
            'views' => $validated['views'],
            'slide_duration' => $validated['slide_duration'] ?? 7000,
            'view_duration' => $validated['view_duration'] ?? 60000,
        ]);

        return redirect()->route('signage.admin')
            ->with('message', 'New screen added!');
    }

    /**
     * Show the form for editing a screen.
     */
    public function editScreen(Screen $screen)
    {
        $views = Screen::VIEW_TYPES;

        return view('dashboard.signage.admin.screens.edit', compact('screen', 'views'));
    }

    /**
     * Update the specified screen.
     */
    public function updateScreen(Request $request, Screen $screen)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:screens,name,' . $screen->id,
            'views' => 'required|array|min:1',
            'views.*' => 'in:' . implode(',', Screen::VIEW_TYPES),
            'slide_duration' => 'nullable|integer|min:1000|max:60000',
            'view_duration' => 'nullable|integer|min:10000|max:600000',
        ]);

        $screen->update([
            'name' => $validated['name'],
            'views' => $validated['views'],
            'slide_duration' => $validated['slide_duration'] ?? 7000,
            'view_duration' => $validated['view_duration'] ?? 60000,
        ]);

        return redirect()->route('signage.admin')
            ->with('message', 'Screen updated successfully!');
    }

    /**
     * Remove the specified screen.
     */
    public function destroyScreen(Screen $screen)
    {
        $screen->delete();

        return redirect()->route('signage.admin')
            ->with('message', 'Screen deleted successfully!');
    }
}
