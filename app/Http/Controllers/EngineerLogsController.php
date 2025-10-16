<?php

namespace App\Http\Controllers;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\EngineerLogs;
use App\Utils\Globals;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EngineerLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.reports.engineers.index');
    }
    public function calendarView(Request $request)
    {
         // $data = Booking::where('country','KENYA')->whereDate('start', '>=', $request->start)
            // ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title','start', 'end']);
            $data = EngineerLogs::whereDate('start', '>=', $request->start)
            ->whereDate('end',   '<=', $request->end)
            ->get(['id', 'title', 'start','end','color','new_development']);

            return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reports.engineers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $logs = new EngineerLogs();
        $logs->title = $user->name;
        $logs->date = $request->input('date');
        $logs->start =  $request->input('date');
        $logs->end =  $request->input('date');
        $logs->problems =  $request->input('problems');
        $logs->resolutions =  $request->input('resolutions');
        $logs->new_development =  $request->input('new_development');
        $logs->comments =  $request->input('comments');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $logs->user_id = $user->id;
        $logs->color = $rand_background;
        $logs->save();
        // $cc_emails = DB::select('SELECT email from users');
        $cc_emails = Globals::mailingGroups("Engineers");
        $details = [
            'cc_emails' => $cc_emails,
            'email' => "donald.saola@newscentral.ng",
            'title' => $logs->title,
            'status' =>  $logs->problems,
            'body' =>  $logs->resolutions,
            'model' =>  'Engineer Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Report');
        return redirect()->route('engineers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $log = EngineerLogs::with('user')->find($id);
      $date =  $log->date;
         $details = [
            // 'email' => $logs->user->email,
            'id' =>$log->id,
            'problems' => $log->problems,
            'resolutions' =>  $log->resolutions,
            'new_development' =>  $log->new_development,
            'comments' =>  $log->comments,
            'date' => \Carbon\Carbon::parse($date)->format('l, jS \of F, Y. '),
            'user_id' => $log->user_id,

        ];
        return view('dashboard.reports.engineers.show', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \App\Models\EngineerLogs  $logs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $log = EngineerLogs::all()->find($id);
        return view('dashboard.reports.engineers.edit', compact('log'));
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
        $log = EngineerLogs::find($id);
        $log->title = $user->name;
        $log->date = $request->input('date');
        $log->start =  $request->input('date');
        $log->end =  $request->input('date');
        $log->problems =  $request->input('problems');
        $log->resolutions =  $request->input('resolutions');
        $log->new_development =  $request->input('new_development');
        $log->comments =  $request->input('comments');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $log->user_id = $user->id;
        $log->color = $rand_background;
        $log->save();
        // $cc_emails = DB::select('SELECT email from users');
        $cc_emails = Globals::mailingGroups("Engineers");
        $details = [
            'cc_emails' => $cc_emails,
            'email' => "donald.saola@newscentral.ng",
            'title' => $log->title,
            'status' =>  $log->problems,
            'body' =>  $log->resolutions,
            'model' =>  'Engineer Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Changes saved!');
        return redirect()->route('engineers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,EngineerLogs $id)
    {

        $password = $request->input('password');
        if($password =="githuber@nuel0"){
            DB::table('logs')->where('id', $id)->delete();
            $request->session()->flash('message', 'Log Deleted!');
        return redirect()->route('engineers.index');
        }
        else{
        $request->session()->flash('message', 'Superuser Password Required for this action!');
        return redirect()->route('engineers.index');
        }
    }
}
