<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('dashboard.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('dashboard.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        Location::create($request->only('name', 'address'));

        return redirect()->route('locations.index')->with('message', 'Location added successfully.');
    }

    public function edit(Location $location)
    {
        return view('dashboard.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        $location->update($request->only('name', 'address'));

        return redirect()->route('locations.index')->with('message', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('message', 'Location deleted successfully.');
    }
}
