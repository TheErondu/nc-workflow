<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.create')->with('mesaage', 'Permission created successfully.');
    }
}
