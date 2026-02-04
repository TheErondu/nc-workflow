<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AudioLogs;
use Illuminate\Http\Request;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class AudioLogsController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.audiologs.index');
    }

    public function create()
    {
        $users = User::all();
        return view('dashboard.reports.audiologs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sto' => 'required',
            'timing' => 'required',
            'programmes' => 'required',
            'remarks' => 'required',
            'squeezbacks' => 'required',
            'tc' => 'required',
            'traffic' => 'required',
            'handed_over_to' => 'required',
            'log_date' => 'required|date',
        ]);

        $user = Auth::user();
        $background_colors = ['#028336', '#ad2323', '#b1a514'];
        $logDate = $request->input('log_date') . ' ' . date('H:i:s');

        $log = AudioLogs::create([
            'sto' => $request->input('sto'),
            'timing' => $request->input('timing'),
            'programmes' => $request->input('programmes'),
            'remarks' => $request->input('remarks'),
            'squeezbacks' => $request->input('squeezbacks'),
            'tc' => $request->input('tc'),
            'traffic' => $request->input('traffic'),
            'handed_over_to' => $request->input('handed_over_to'),
            'start' => $logDate,
            'end' => $logDate,
            'color' => $background_colors[array_rand($background_colors)],
            'title' => $request->input('sto'),
            'user_id' => $user->id,
        ]);

        $cc_emails = User::whereIn('department_id', [11, 3])->pluck('email')->toArray();
        $details = [
            'email' => $user->email,
            'title' => $log->remarks,
            'status' => $log->handed_over_to,
            'body' => $log->remarks,
            'model' => 'Audio Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails,
        ];
        Event::dispatch(new RecordCreatedEvent($details));

        return redirect()->route('audio-logs.index')->with('message', 'Successfully created Audio Log');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $audio_log = AudioLogs::findOrFail($id);
        $users = User::all();
        return view('dashboard.reports.audiologs.edit', compact('audio_log', 'users'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $log = AudioLogs::findOrFail($id);

        $logDate = $request->input('log_date') ? $request->input('log_date') . ' ' . date('H:i:s') : $log->start;

        $log->update([
            'sto' => $request->input('sto'),
            'timing' => $request->input('timing'),
            'programmes' => $request->input('programmes'),
            'remarks' => $request->input('remarks'),
            'squeezbacks' => $request->input('squeezbacks'),
            'tc' => $request->input('tc'),
            'traffic' => $request->input('traffic'),
            'handed_over_to' => $request->input('handed_over_to'),
            'title' => $request->input('sto'),
            'start' => $logDate,
            'end' => $logDate,
        ]);

        $cc_emails = User::whereIn('department_id', [11, 3])->pluck('email')->toArray();
        $details = [
            'email' => $user->email,
            'title' => $log->remarks,
            'status' => $log->handed_over_to,
            'body' => $log->remarks,
            'model' => 'Audio Logs',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails,
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('audio-logs.index')->with('message', 'Successfully updated Audio Log');
    }

    public function destroy($id)
    {
        $log = AudioLogs::find($id);
        if ($log) {
            $log->delete();
        }
        return redirect()->route('audio-logs.index')->with('message', 'Successfully deleted Audio Log');
    }
}
