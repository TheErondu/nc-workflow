<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use App\Models\SignageSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignageSlideController extends Controller
{
    /**
     * Display a listing of slides (excludes birthdays).
     */
    public function index()
    {
        $slidesByViewType = SignageSlide::with('user')
            ->where('view_type', '!=', 'birthdays')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('view_type');

        return view('dashboard.signage.admin.slides.index', compact('slidesByViewType'));
    }

    /**
     * Display birthdays in calendar view.
     */
    public function birthdaysIndex()
    {
        $birthdays = SignageSlide::with('user')
            ->where('view_type', 'birthdays')
            ->orderBy('birthday_date')
            ->get();

        return view('dashboard.signage.admin.birthdays.index', compact('birthdays'));
    }

    /**
     * Show the form for creating a new slide (non-birthday).
     */
    public function create()
    {
        $viewTypes = array_filter(Screen::VIEW_TYPES, fn($type) => $type !== 'birthdays');
        return view('dashboard.signage.admin.slides.create', compact('viewTypes'));
    }

    /**
     * Show the form for creating a new birthday slide.
     */
    public function birthdaysCreate()
    {
        return view('dashboard.signage.admin.birthdays.create');
    }

    /**
     * Store a newly created slide (non-birthday).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'view_type' => 'required|in:showreels,general',
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'active_from' => 'nullable|date',
            'active_until' => 'nullable|date|after_or_equal:active_from',
        ]);

        $imagePath = $request->file('image')->store('signage', 'media');
        $imagePath = basename($imagePath);

        SignageSlide::create([
            'view_type' => $validated['view_type'],
            'title' => $validated['title'] ?? null,
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'active_from' => $validated['active_from'] ?? null,
            'active_until' => $validated['active_until'] ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('signage.slides.index')
            ->with('message', 'Slide created successfully!');
    }

    /**
     * Store a newly created birthday slide.
     */
    public function birthdaysStore(Request $request)
    {
        $validated = $request->validate([
            'celebrant_name' => 'required|string|max:255',
            'birthday_date' => 'required|date',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')->store('signage', 'media');
        $imagePath = basename($imagePath);

        SignageSlide::create([
            'view_type' => 'birthdays',
            'celebrant_name' => $validated['celebrant_name'],
            'birthday_date' => $validated['birthday_date'],
            'image_path' => $imagePath,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('signage.birthdays.index')
            ->with('message', 'Birthday added successfully!');
    }

    /**
     * Show the form for editing a slide (non-birthday).
     */
    public function edit(SignageSlide $slide)
    {
        $viewTypes = array_filter(Screen::VIEW_TYPES, fn($type) => $type !== 'birthdays');
        return view('dashboard.signage.admin.slides.edit', compact('slide', 'viewTypes'));
    }

    /**
     * Show the form for editing a birthday slide.
     */
    public function birthdaysEdit(SignageSlide $slide)
    {
        return view('dashboard.signage.admin.birthdays.edit', compact('slide'));
    }

    /**
     * Update the specified slide (non-birthday).
     */
    public function update(Request $request, SignageSlide $slide)
    {
        $validated = $request->validate([
            'view_type' => 'required|in:showreels,general',
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'active_from' => 'nullable|date',
            'active_until' => 'nullable|date|after_or_equal:active_from',
        ]);

        $data = [
            'view_type' => $validated['view_type'],
            'title' => $validated['title'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'active_from' => $validated['active_from'] ?? null,
            'active_until' => $validated['active_until'] ?? null,
        ];

        if ($request->hasFile('image')) {
            Storage::disk('media')->delete('signage/' . $slide->image_path);
            $imagePath = $request->file('image')->store('signage', 'media');
            $data['image_path'] = basename($imagePath);
        }

        $slide->update($data);

        return redirect()->route('signage.slides.index')
            ->with('message', 'Slide updated successfully!');
    }

    /**
     * Update the specified birthday slide.
     */
    public function birthdaysUpdate(Request $request, SignageSlide $slide)
    {
        $validated = $request->validate([
            'celebrant_name' => 'required|string|max:255',
            'birthday_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data = [
            'celebrant_name' => $validated['celebrant_name'],
            'birthday_date' => $validated['birthday_date'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('media')->delete('signage/' . $slide->image_path);
            $imagePath = $request->file('image')->store('signage', 'media');
            $data['image_path'] = basename($imagePath);
        }

        $slide->update($data);

        return redirect()->route('signage.birthdays.index')
            ->with('message', 'Birthday updated successfully!');
    }

    /**
     * Remove the specified slide.
     */
    public function destroy(SignageSlide $slide)
    {
        Storage::disk('media')->delete('signage/' . $slide->image_path);
        $slide->delete();

        return redirect()->route('signage.slides.index')
            ->with('message', 'Slide deleted successfully!');
    }

    /**
     * Remove the specified birthday slide.
     */
    public function birthdaysDestroy(SignageSlide $slide)
    {
        Storage::disk('media')->delete('signage/' . $slide->image_path);
        $slide->delete();

        return redirect()->route('signage.birthdays.index')
            ->with('message', 'Birthday deleted successfully!');
    }

    /**
     * Return birthday slides as FullCalendar-compatible events.
     */
    public function birthdayCalendarEvents()
    {
        $currentYear = now()->year;

        $birthdaySlides = SignageSlide::where('view_type', 'birthdays')
            ->whereNotNull('birthday_date')
            ->get();

        $events = $birthdaySlides->map(function ($slide) use ($currentYear) {
            $birthdayDate = $slide->birthday_date;
            $eventDate = $currentYear . '-' . $birthdayDate->format('m-d');

            return [
                'id' => $slide->id,
                'title' => $slide->celebrant_name,
                'start' => $eventDate,
                'backgroundColor' => $slide->is_active ? '#28a745' : '#6c757d',
                'borderColor' => $slide->is_active ? '#28a745' : '#6c757d',
                'extendedProps' => [
                    'celebrant_name' => $slide->celebrant_name,
                    'image_url' => $slide->image_url,
                    'slide_id' => $slide->id,
                    'is_active' => $slide->is_active,
                    'original_date' => $birthdayDate->format('M d'),
                ],
            ];
        });

        return response()->json($events);
    }
}
