<?php

namespace App\Http\Controllers;

use App\Events\EngineerAssignedEvent;
use App\Exports\Issues\IssuesExport;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Events\TicketCreatedEvent;
use App\Events\TicketUpdatedEvent;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\IssueRaisedAdminNotification;
use App\Notifications\IssueClosedAdminNotification;
use App\Jobs\SendIssueAdminEmailsJob;
use Illuminate\Support\Facades\Notification;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user     = Auth::user();
        $userName = $user->name;

        $base = $user->can('fix-issues')
            ? Issue::query()
            : Issue::where('raised_by', $userName);

        $openCount   = (clone $base)->where('status', 'OPEN')->count();
        $closedCount = (clone $base)->where('status', 'CLOSED')->count();
        $totalCount  = $openCount + $closedCount;

        return view('dashboard.issues.index', compact('openCount', 'closedCount', 'totalCount'));
    }

    public function datatables(Request $request)
    {
        $user     = Auth::user();
        $userName = $user->name;
        $canFix   = $user->can('fix-issues');

        $query = $canFix
            ? Issue::query()
            : Issue::where('raised_by', $userName);

        if ($request->filled('status_filter')) {
            $query->where('status', $request->input('status_filter'));
        }

        $dt = DataTables::of($query);

        if ($canFix) {
            $dt->addColumn('checkbox', function ($issue) {
                if ($issue->status !== 'CLOSED') {
                    return '<input type="checkbox" class="issue-checkbox" data-id="' . $issue->id . '">';
                }
                return '';
            });
        }

        return $dt
            ->addColumn('edit_link', function ($issue) {
                return '<a href="' . route('issues.edit', $issue->id) . '" title="Edit issue"><i class="far fa-edit"></i></a>';
            })
            ->editColumn('status', function ($issue) {
                $color = $issue->status === 'OPEN' ? '#c0392b' : ($issue->status === 'CLOSED' ? '#27ae60' : '#555');
                return '<span class="badge" style="background-color:' . $color . ';">' . e($issue->status) . '</span>';
            })
            ->editColumn('date', function ($issue) {
                return $issue->getRawOriginal('date');
            })
            ->editColumn('resolved_date', function ($issue) {
                return $issue->getRawOriginal('resolved_date');
            })
            ->rawColumns($canFix ? ['checkbox', 'edit_link', 'status'] : ['edit_link', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $users = User::orderBy('name')->get(['id', 'name', 'department_id']);
        return view('dashboard.issues.create', compact('departments', 'users'));
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
            'item_name' => 'required',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'department' => 'nullable|string',
            'on_behalf_of_user_id' => 'nullable|integer|exists:users,id',
        ]);
        $admin = Auth::user();
        $onBehalfOfId = $request->input('on_behalf_of_user_id');

        if ($admin->hasRole('Admin') && $onBehalfOfId) {
            $targetUser = User::find($onBehalfOfId);
            $raisedby = $targetUser->name;
        } else {
            $targetUser = $admin;
            $raisedby = !empty($admin->name) ? $admin->name : (!empty($admin->username) ? $admin->username : explode('@', $admin->email)[0]);
        }
        $user = $targetUser;
        $issue = new Issue();
        $issue->item_name     = $request->input('item_name');
        $issue->description = $request->input('description');
        $issue->date = \Carbon\Carbon::now();
        $issue->location = $request->input('location');
        $issue->raised_by = $raisedby;
        $issue->department = $request->input('department');
        $issue->status = 'OPEN';
        $issue->fixed_by = $request->input('fixed_by');
        $issue->action_taken = $request->input('action_taken');
        $issue->cause_of_breakdown = $request->input('cause_of_breakdown');
        $issue->engineers_comment = $request->input('engineers_comment');
        $issue->resolved_date = $request->input('resolved_date');
        $issue->save();
        $copy = Department::where('name', 'Engineers')->pluck('mail_group')->implode('');
        $email = $user->email;
        $url = route('home');
        $link = $url . '/' . 'issues' . '/' . $issue->id . '/edit';
        $details = [
            'link' => $link,
           'department' => $issue->department,
            'email' =>  $email,
            'raised_by' => $raisedby,
            'description' =>  $issue->description,
            'status' =>  $issue->status,
            'fixed_by_name' =>$issue->fixed_by,
            'item_name' =>  $issue->item_name,
            'resolved_date' =>  $issue->resolved_date,
            'engineers_comment' =>  $issue->engineers_comment,
            'copy' => $copy
        ];
        Event::dispatch(new TicketCreatedEvent($details));

        // DB notification sync (badge appears on next poll), email + push queued
        $admins = User::role('Admin')->get();
        Notification::sendNow($admins, new IssueRaisedAdminNotification($issue));
        $adminIds = $admins->pluck('id')->toArray();
        SendIssueAdminEmailsJob::dispatch($adminIds, $issue, 'raised');

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
        $issue = Issue::findOrFail($id);
        // Get engineers (department_id = 11)
        $engineers = User::where('department_id', 11)->get(['name']);

        $issue_status = array_keys(Issue::STATUSES);
        $departments = Department::all();
        $users = User::all();
        return view('dashboard.issues.edit', compact('issue', 'engineers', 'users', 'departments', 'issue_status'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function AssignEngineer(Request $request, $id)
    {
        $issue = Issue::find($id);
        $issue->assigned_engineer = $request->input('assigned_engineer');
        $issue->save();
        $email = User::where('username', $issue->raised_by)->pluck('email');
        $supervisor = Auth::user()->username;
        $copy = User::where('username', $issue->assigned_engineer)->pluck('email');
        $url = route('home');
        $link = $url . '/' . 'issues' . '/' . $issue->id . '/edit';
        $details = [
            'link' => $link,
            'supervisor' => $supervisor,
            'department' => $issue->department,
            'status' =>  $issue->status,
            'assigned_engineer' =>  $issue->assigned_engineer,
            'description' => $issue->description,
            'item_name' =>  $issue->item_name,
            'copy' => $copy,
            'email' => $email
        ];
        Event::dispatch(new EngineerAssignedEvent($details));
        $request->session()->flash('message', 'Engineer Assigned to Ticket!');
        return redirect()->route('issues.edit',$issue->id);


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

        $issue = Issue::find($id);
        $user = Auth::user();
        $previousStatus = $issue->status;
        $issue->item_name   = $request->input('item_name');
        $issue->description = $request->input('description');
        $issue->date        = $request->input('date');
        $issue->location    = $request->input('location');
        $issue->raised_by   = $request->input('raised_by') ?? $issue->raised_by;
        $issue->department  = $request->input('department');
        if ($user->can('fix-issues')) {
            $issue->status             = $request->input('status');
            $issue->fixed_by           = $issue->fixed_by;
            $issue->action_taken       = $request->input('action_taken');
            $issue->cause_of_breakdown = $request->input('cause_of_breakdown');
            $issue->engineers_comment  = $request->input('engineers_comment');
            $issue->resolved_date      = date('d-m-Y H:i:s');
        }
        $issue->save();

        // If issue just closed, notify admins
        if ($previousStatus !== 'CLOSED' && $issue->status === 'CLOSED') {
            $admins = User::role('Admin')->get();
            Notification::sendNow($admins, new IssueClosedAdminNotification($issue));
            $adminIds = $admins->pluck('id')->toArray();
            SendIssueAdminEmailsJob::dispatch($adminIds, $issue, 'closed');
        }

        $email = User::where('username', 'Like', "$issue->raised_by")->pluck('email')->implode('');
        $copy = Department::where('name', 'Engineers')->pluck('mail_group')->implode('');
        $url = route('home');
        $link = $url . '/' . 'issues' . '/' . $issue->id . '/edit';

        $details = [
            'link' => $link,
            'email' =>  $email,
            'status' =>  $issue->status,
            'fixed_by_name' => $issue->fixed_by,
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
     * Bulk close selected issues.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkClose(Request $request)
    {
        $request->validate([
            'issue_ids' => 'required|array',
            'issue_ids.*' => 'integer|exists:issues,id',
        ]);

        $count = Issue::whereIn('id', $request->input('issue_ids'))
            ->where('status', '!=', 'CLOSED')
            ->update([
                'status' => 'CLOSED',
                'resolved_date' => date('d-m-Y H:i:s'),
            ]);

        return redirect()->route('issues.index')->with('message', $count . ' issue(s) closed successfully.');
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

    public function export()
    {
        $user = Auth::user();
        $userName = $user->name;

        if ($user->can('fix-issues')) {
            $issues = Issue::orderBy('id', 'desc')->get();
        } else {
            $issues = Issue::where('raised_by', $userName)->orderBy('id', 'desc')->get();
        }

        return Excel::download(new IssuesExport($issues), 'issues.xlsx');
    }
}
