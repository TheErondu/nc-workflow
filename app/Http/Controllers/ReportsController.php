<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Reports;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directors_report = Reports::all();

        return view('dashboard.reports.directors.index', compact('directors_report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view('dashboard.reports.directors.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([

            'log_date' => 'required',
            'director' => 'required'
        ]);

        $user = Auth::user();

        $requestData = $request->except('_token');
        $requestData['start'] = $requestData['log_date'];
        $requestData['end'] = $requestData['log_date'];
        $requestData['user_id'] = $user->id;



        // Extract dynamic sections from the request data
        $dynamicSections = $requestData['bulletin'] ?? [];

        // Initialize an array to store the structured data
        $structuredSections = [];

        // Iterate through each dynamic section
        foreach ($dynamicSections as $index => $bulletin) {
            $structuredSections[] = [
                'bulletin' => $bulletin,
                'dts_in' => $requestData['dts_in'][$index] ?? null,
                'actual_in' => $requestData['actual_in'][$index] ?? null,
                'variance1' => $requestData['variance1'][$index] ?? null,
                'dts_out' => $requestData['dts_out'][$index] ?? null,
                'actual_out' => $requestData['actual_out'][$index] ?? null,
                'variance2' => $requestData['variance2'][$index] ?? null,
                'comment' => $requestData['comment'][$index] ?? null,
            ];
        }

        $structuredSectionsJson = json_encode($structuredSections);

        $requestData['bulletins'] = $structuredSectionsJson;

        $requestData['title'] = $structuredSections[0]['bulletin'];
        // Save to the database
        $reports = Reports::create($requestData);
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->title,
            'status' => $reports->dts_in,
            'body' => $reports->comment,
            'model' => 'Director Reports',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('reports.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reports  $reports
     * @return \Illuminate\Http\Response
     */
    public function show(Reports $reports)
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
        $reports = Reports::all()->find($id);
        $users = User::all();
        return view('dashboard.reports.directors.edit', compact('reports', 'users'));
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
        $user = Auth::user();

        $requestData = $request->except('_token');
        $requestData['start'] = $requestData['log_date'];
        $requestData['end'] = $requestData['log_date'];
        $requestData['user_id'] = $user->id;
        // Extract dynamic sections from the request data
        $dynamicSections = $requestData['bulletin'] ?? [];

        // Initialize an array to store the structured data
        $structuredSections = [];

        // Iterate through each dynamic section
        foreach ($dynamicSections as $index => $bulletin) {
            $structuredSections[] = [
                'bulletin' => $bulletin,
                'dts_in' => $requestData['dts_in'][$index] ?? null,
                'actual_in' => $requestData['actual_in'][$index] ?? null,
                'variance1' => $requestData['variance1'][$index] ?? null,
                'dts_out' => $requestData['dts_out'][$index] ?? null,
                'actual_out' => $requestData['actual_out'][$index] ?? null,
                'variance2' => $requestData['variance2'][$index] ?? null,
                'comment' => $requestData['comment'][$index] ?? null,
            ];
        }

        $structuredSectionsJson = json_encode($structuredSections);

        $requestData['bulletins'] = $structuredSectionsJson;

        $requestData['title'] = $structuredSections[0]['bulletin'];

        $reports = Reports::Find($id);
       // dd($requestData);
        $reports->update($requestData);
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->title,
            'status' => $reports->dts_in,
            'body' => $reports->comment,
            'model' => 'Directors Report',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Edited Report');
        return redirect()->route('reports.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reports = Reports::find($id);
        if ($reports) {
            $reports->delete();
        }
        return redirect()->route('reports.index')->with('message', 'Successfully Deleted Report');
    }
}
