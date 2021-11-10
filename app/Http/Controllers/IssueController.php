<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Events\SendMail;
use App\Models\Department;
use App\Models\Users;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('fix-issues')) {
            $issues = Issue::all();
        }
        $issues = Issue::where('user_id', Auth::user()->id);
        $users = Users::all();
        return view('dashboard.issues.index', compact('issues', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.issues.create', compact('departments'));
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
            'item_name'                 => 'required'
        ]);
        $raisedby = Auth::user()->name;
        $issue = new Issue();
        $issue->item_name     = $request->input('item_name');
        $issue->description = $request->input('description');
        $issue->date = $request->input('date');
        $issue->location = $request->input('location');
        $issue->raised_by = $raisedby;
        $issue->department = $request->input('department');
        $issue->status = $request->input('status');
        $issue->fixed_by = $request->input('fixed_by');
        $issue->action_taken = $request->input('action_taken');
        $issue->cause_of_breakdown = $request->input('cause_of_breakdown');
        $issue->engineers_comment = $request->input('engineers_comment');
        $issue->resolved_date = $request->input('resolved_date');
        $issue->save();
        $request->session()->flash('message', 'Successfully added Issue');
        return redirect()->route('issues.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
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
        $issue = Issue::all()->find($id);

        $issue_status   = array(
            'OPEN', 'RESOLVING..', 'CLOSED'
        );
        $departments = Department::all();
        $users = Users::all();
        return view('dashboard.issues.edit', compact('issue', 'users', 'departments', 'issue_status'));
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
        $issue = Issue::find($id);
        $user = auth()->user();
        $fixedBy = auth()->user()->name;
        $issue->item_name     = $request->input('item_name');
        $issue->description = $request->description('description');
        $issue->date = $request->input('date');
        $issue->location = $request->input('location');
        $issue->raised_by = $request->input('raised_by');
        $issue->department = $request->input('department');
        if ($user->hasRole('ENGINEER')) {
            $issue->status = $request->input('status');
            $issue->fixed_by = $fixedBy;
            $issue->action_taken = $request->input('action_taken');
            $issue->cause_of_breakdown = $request->input('cause_of_breakdown');
            $issue->engineers_comment = $request->input('engineers_comment');
            $issue->resolved_date = $request->input('resolved_date');
            $issue->status = $request->input('status');
        }
        $issue->save();
        Event::dispatch(new SendMail($issue->hod->id));
        $request->session()->flash('message', 'Successfully Edited Issue');
        return redirect()->route('issues.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issue = Issue::find($id);
        if ($issue) {
            $issue->delete();
        }
        return redirect()->route('issues.index')->with('message', 'Successfully Deleted Issue');
    }
}
