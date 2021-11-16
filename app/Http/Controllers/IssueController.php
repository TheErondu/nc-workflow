<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Events\SendMail;
use App\Events\TicketCreatedEvent;
use App\Events\TicketUpdatedEvent;
use App\Mail\TicketCreated;
use App\Models\Department;
use App\Models\Users;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
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
        $raised_issues = Issue::where('raised_by', Auth::user()->id)->get();
        if (request()->query('type') === 'raised') {

            $issues = $raised_issues;
        } elseif (($user->can('fix-issues'))) {
            $issues = Issue::all();
        } else
            $issues = $raised_issues;
        $users = Users::all();
        return view('dashboard.issues.index', compact('issues', 'raised_issues', 'users'));
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
        $copy = Department::where('name', 'Engineers')->pluck('mail_group')->implode('');
        $email = Users::where('username', $issue->raised_by)->pluck('email')->implode('');
        $url = route('home');
        $link = $url . '/' . 'issues' . '/' . $issue->id . '/edit';
        $details = [
            'link' => $link,
            'email' =>  $email,
            'status' =>  $issue->status,
            'fixed_by_name' => auth()->user()->name,
            'item_name' =>  $issue->item_name,
            'resolved_date' =>  $issue->resolved_date,
            'engineers_comment' =>  $issue->engineers_comment,
            'copy' => $copy
        ];
        Event::dispatch(new TicketCreatedEvent($details));
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
            'OPEN', 'CLOSED'
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
        $validatedData = $request->validate([]);
        $issue = Issue::find($id);
        $user = auth()->user();
        $issue->item_name     = $request->input('item_name');
        $issue->description = $request->input('description');
        $issue->date = $request->input('date');
        $issue->location = $request->input('location');
        $issue->raised_by = $request->input('raised_by');
        $issue->department = $request->input('department');
        if ($user->can('fix-issues')) {
            $fixedBy = auth()->user()->username;
            $issue->status = $request->input('status');
            $issue->fixed_by = $fixedBy;
            $issue->action_taken = $request->input('action_taken');
            $issue->cause_of_breakdown = $request->input('cause_of_breakdown');
            $issue->engineers_comment = $request->input('engineers_comment');
            $issue->resolved_date = date('d-m-Y H:i:s');
            $issue->status = $request->input('status');
        }
        $issue->save();
        $email = Users::where('username', $issue->raised_by)->pluck('email')->implode('');
        $copy = Department::where('name', 'Engineers')->pluck('mail_group')->implode('');
        $url = route('home');
        $link = $url . '/' . 'issues' . '/' . $issue->id . '/edit';

        // dd($link);
        $details = [
            'link' => $link,
            'email' =>  $email,
            'status' =>  $issue->status,
            'fixed_by_name' => auth()->user()->name,
            'item_name' =>  $issue->item_name,
            'resolved_date' =>  $issue->resolved_date,
            'engineers_comment' =>  $issue->engineers_comment,
            'copy' => $copy
        ];
        Event::dispatch(new TicketUpdatedEvent($details));
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
