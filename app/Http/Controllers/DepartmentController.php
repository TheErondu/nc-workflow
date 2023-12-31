<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Events\SendMail;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $departments = Department::all();
        $users = Users::all();
        return view('dashboard.departments.index', compact('departments','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Users::all();
        return view('dashboard.departments.create',compact('users'));
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
        $department->user_id = $request->input('hod');
        $department->color = $request->input('color');
        $department->mail_group = $request->input('mail_group');
        $department->save();
        $user = Auth::user();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $department->name,
            'status' =>  $department->status,
            'body' =>  $department->mail_group,
            'model' =>  'Departments',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
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
        $users = Users::all();
        return view('dashboard.departments.edit',compact('department','users'));
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
        $department->user_id = $request->input('hod');
        $department->color = $request->input('color');
        $department->mail_group = $request->input('mail_group');
        $department->save();
        $user = Auth::user();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $department->name,
            'status' =>  $department->status,
            'body' =>  $department->mail_group,
            'model' =>  'Departments',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
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
