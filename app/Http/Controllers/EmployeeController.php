<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::all()->sortByDesc('created_at');
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
        $roles = Role::pluck('name','name')->all();
        $status = array(
            'inactive','active',
        );
        return view('dashboard.employees.create',compact('departments','status','roles'));
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
            'status'           => 'required',
            'roles'           => 'required'
        ]);

        $employee = new User();
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->department_id = $request->input('department_id');
        $employee->password = Hash::make($request->input('password'));
        $employee->status = $request->input('status');
        $employee->role = $request->input('roles');
        $employee->assignRole($request->input('roles'));
        $employee->save();
        $user = Auth::user();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $employee->name,
            'status' =>  $employee->email,
            'body' =>  $employee->department->name,
            'model' =>  'Employees',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully added User');

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
    * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee  = User::find($id);

        return view('dashboard.employees.show',compact('employee'));
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
        $roles = Role::pluck('name','name')->all();
        $departments = Department::all();
        $status = array(
            'inactive','active',
        );
        return view('dashboard.employees.edit',compact('employee','departments','status','roles'));
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
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $employee->assignRole($request->input('roles'));
        $employee->name     = $request->input('name');
        $employee->email = $request->input('email');
        $employee->role = $request->input('roles');
        $employee->department_id = $request->input('department_id');
        $employee->status = $request->input('status');
        $employee->save();
        $user = Auth::user();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $employee->name,
            'status' =>  $employee->email,
            'body' =>  $employee->department->name,
            'model' =>  'Employees',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Updated User info');

        return redirect()->route('employees.index');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resetpass(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reset_password'             => 'required',
        ]);

        $employee = User::find($id);
        $email = $employee->email;
        $newpassword = $request->input('reset_password');
        Mail::to($email)->send( new \App\Mail\ResetPass($newpassword));
        $employee->password = Hash::make($request->input('reset_password'));
        $employee->save();
        $request->session()->flash('message', 'Password Reset!');

        return redirect()->route('employees.index');
    }


    public function destroy(Request $request, Employee $employee)
    {
       $user = User::find($employee->id);
       $user->store_request()->delete();
       $user->batch_store_request()->delete();
       $user->delete();
       $request->session()->flash('message', 'Employee deleted sucessfully!');
       return redirect()->route('employees.index');
    }
}
