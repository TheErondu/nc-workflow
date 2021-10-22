<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::all();
        return view('dashboard.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $status = array(
            'inactive','active',
        );
        return view('dashboard.employees.create',compact('departments','status'));
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
            'name'             => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'department_id'           => 'required',
            'status'           => 'required'
        ]);

        $employee = new User();
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->department_id = $request->input('department_id');
        $employee->password = Hash::make($request->input('password'));
        $employee->status = $request->input('status');
        $employee->save();
        $request->session()->flash('message', 'Successfully added User');

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $employee  = Employee::find($id);
        $departments = Department::all();
        $status = array(
            'Inactive','Active',
        );
        return view('dashboard.employees.edit',compact('employee','departments','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'             => 'required',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id),],
            'department_id'           => 'required',
            'status'           => 'required'
        ]);

        $employee = User::find($id);
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->department_id = $request->input('department_id');
        $employee->status = $request->input('status');
        $employee->save();
        $request->session()->flash('message', 'Successfully Updated User info');

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
