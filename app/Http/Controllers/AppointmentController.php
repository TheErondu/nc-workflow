<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.appointments.index');
    }

    public function create(Request $request)
    {
        $employees = Employee::all();
        return view('dashboard.appointments.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'status' => 'required|in:pending,confirmed,cancelled',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('appointments/photos', 'public');
            $validatedData['photo'] = $photoPath;
        }
        $validatedData['user_id'] = $user->id;

        // Create the appointment
        Appointment::create($validatedData);

        // Redirect with a success message
        return redirect()->route('appointments.index')->with('message', 'Appointment created successfully!');
    }


    public function edit(Request $request, Appointment $appointment)
    {
        $employees = Employee::all();
        return view('dashboard.appointments.edit', compact('appointment','employees'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'status' => 'required|in:pending,confirmed,cancelled',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Handle the photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($appointment->photo) {
                Storage::disk('public')->delete($appointment->photo);
            }
            $photoPath = $request->file('photo')->store('appointments/photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Update the appointment
        $appointment->update($validatedData);

        // Redirect with a success message
        return redirect()->route('appointments.index')->with('message', 'Appointment updated successfully!');
    }
}
