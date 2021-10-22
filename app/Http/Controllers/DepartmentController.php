<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $departments = Department::all();
        return view('dashboard.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                 => 'required'
        ]);
        $department = new Department();
        $department->name = $request->input('name');
        $department->color = $request->input('color');
        $department->save();
        $request->session()->flash('message', 'Successfully added Department');
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::all()->find($id);
        return view('dashboard.departments.edit',compact('department'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'                 => 'required'
        ]);
        $department = Department::find($id);
        $department->name = $request->input('name');
        $department->color = $request->input('color');
        $department->save();
        $request->session()->flash('message', 'Successfully Edited Department');
        return redirect()->route('departments.index');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $department = Department::find($id);
        if($department){
            $department->delete();
        }
        return redirect()->route('departments.index')->with('message', 'Successfully Deleted Department');

    }
}
