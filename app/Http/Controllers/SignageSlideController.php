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
    public function index(Request $request)
    {
        $query = SignageSlide::with('user')
            ->where('view_type', '!=', 'birthdays');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('view_type', 'like', "%{$search}%");
            });
        }

        // Filter by view type
        if ($request->filled('view_type')) {
            $query->where('view_type', $request->view_type);
        }

        $slides = $query->orderBy('view_type')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        $viewTypes = SignageSlide::where('view_type', '!=', 'birthdays')
            ->distinct()
            ->pluck('view_type');

        return view('dashboard.signage.admin.slides.index', compact('slides', 'viewTypes'));
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
            'slide_type' => 'required|in:image,video',
            'title' => 'nullable|string|max:255',
            'image' => 'required_if:slide_type,image|nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'video' => 'required_if:slide_type,video|nullable|mimes:mp4,webm,ogg|max:102400',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'active_from' => 'nullable|date',
            'active_until' => 'nullable|date|after_or_equal:active_from',
        ]);

        $slideData = [
            'view_type' => $validated['view_type'],
            'slide_type' => $validated['slide_type'],
            'title' => $validated['title'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'active_from' => $validated['active_from'] ?? null,
            'active_until' => $validated['active_until'] ?? null,
            'user_id' => auth()->id(),
        ];

        if ($validated['slide_type'] === 'video') {
            $videoPath = $request->file('video')->store('signage', 'media');
            $slideData['video_path'] = basename($videoPath);
        } else {
            $imagePath = $request->file('image')->store('signage', 'media');
            $slideData['image_path'] = basename($imagePath);
        }

        SignageSlide::create($slideData);

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
            'slide_type' => 'required|in:image,video',
            'title' => 'nullable|string|max:255',
            'image' => 'required_if:slide_type,image,old_slide_type,video|nullable|image|mimes:jpg,jpeg,png,gif|max:5120',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:102400',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'active_from' => 'nullable|date',
            'active_until' => 'nullable|date|after_or_equal:active_from',
        ]);

        $data = [
            'view_type' => $validated['view_type'],
            'slide_type' => $validated['slide_type'],
            'title' => $validated['title'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'active_from' => $validated['active_from'] ?? null,
            'active_until' => $validated['active_until'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($slide->image_path) {
                Storage::disk('media')->delete('signage/' . $slide->image_path);
            }
            $imagePath = $request->file('image')->store('signage', 'media');
            $data['image_path'] = basename($imagePath);
        }

        if ($request->hasFile('video')) {
            if ($slide->video_path) {
                Storage::disk('media')->delete('signage/' . $slide->video_path);
            }
            $videoPath = $request->file('video')->store('signage', 'media');
            $data['video_path'] = basename($videoPath);
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
        if ($slide->image_path) {
            Storage::disk('media')->delete('signage/' . $slide->image_path);
        }
        if ($slide->video_path) {
            Storage::disk('media')->delete('signage/' . $slide->video_path);
        }
        $slide->delete();

        return redirect()->route('signage.slides.index')
            ->with('message', 'Slide deleted successfully!');
    }

    /**
     * Remove the specified birthday slide.
     */
    public function birthdaysDestroy(SignageSlide $slide)
    {
        if ($slide->image_path) {
            Storage::disk('media')->delete('signage/' . $slide->image_path);
        }
        if ($slide->video_path) {
            Storage::disk('media')->delete('signage/' . $slide->video_path);
        }
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
