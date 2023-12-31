<?php

namespace App\Http\Controllers\API;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
class ReportsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = DB::table('reports')->orderBy('created_at','desc')->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('dashboard.reports.directors.create');
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
            'bulletin'             => 'required',
            'dts_in'             => 'required',
            'actual_in'           => 'required',
            'variance1'           => 'required',
            'dts_out'           => 'required',
            'actual_out'           => 'required',
            'variance2'         => 'required',
            'comment'         => 'required',
            'b2bulletin'             => 'required',
            'b2dts_in'             => 'required',
            'b2actual_in'           => 'required',
            'b2variance1'           => 'required',
            'b2dts_out'           => 'required',
            'b2actual_out'           => 'required',
            'b2variance2'         => 'required',
            'b2comment'         => 'required',
        ]);

        $user = auth()->user();
        $reports = new Reports();
        $reports->bulletin = $request->input('bulletin');
        $reports->dts_in = $request->input('dts_in');
        $reports->actual_in = $request->input('actual_in');
        $reports->variance1 = $request->input('variance1');
        $reports->dts_out = $request->input('dts_out');
        $reports->actual_out = $request->input('actual_out');
        $reports->variance2 = $request->input('variance2');
        $reports->comment = $request->input('comment');
        $reports->b2bulletin = $request->input('b2bulletin');
        $reports->b2dts_in = $request->input('b2dts_in');
        $reports->b2actual_in = $request->input('b2actual_in');
        $reports->b2variance1 = $request->input('b2variance1');
        $reports->b2dts_out = $request->input('b2dts_out');
        $reports->b2actual_out = $request->input('b2actual_out');
        $reports->b2variance2 = $request->input('b2variance2');
        $reports->b2comment = $request->input('b2comment');
        $reports->user_id = $user->id;
        $reports->save();
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->bulletin,
            'status' =>  $reports->dts_in,
            'body' =>  $reports->comment,
            'model' =>  'Prompter Logs',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
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
        return view('dashboard.reports.directors.edit', compact('reports'));
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
            'bulletin'             => 'required',
            'dts_in'             => 'required',
            'actual_in'           => 'required',
            'variance1'           => 'required',
            'dts_out'           => 'required',
            'actual_out'           => 'required',
            'variance2'         => 'required',
            'comment'         => 'required',
            'b2bulletin'             => 'required',
            'b2dts_in'             => 'required',
            'b2actual_in'           => 'required',
            'b2variance1'           => 'required',
            'b2dts_out'           => 'required',
            'b2actual_out'           => 'required',
            'b2variance2'         => 'required',
            'b2comment'         => 'required',
        ]);
        $user = auth()->user();
        $reports = Reports::find($id);
        $reports->bulletin = $request->input('bulletin');
        $reports->dts_in = $request->input('dts_in');
        $reports->actual_in = $request->input('actual_in');
        $reports->variance1 = $request->input('variance1');
        $reports->dts_out = $request->input('dts_out');
        $reports->actual_out = $request->input('actual_out');
        $reports->variance2 = $request->input('variance2');
        $reports->comment = $request->input('comment');
        $reports->b2bulletin = $request->input('b2bulletin');
        $reports->b2dts_in = $request->input('b2dts_in');
        $reports->b2actual_in = $request->input('b2actual_in');
        $reports->b2variance1 = $request->input('b2variance1');
        $reports->b2dts_out = $request->input('b2dts_out');
        $reports->b2actual_out = $request->input('b2actual_out');
        $reports->b2variance2 = $request->input('b2variance2');
        $reports->b2comment = $request->input('b2comment');
        $reports->user_id = $user->id;
        $reports->save();
        $details = [
            'email' => $reports->user->email,
            'title' => $reports->bulletin,
            'status' =>  $reports->dts_in,
            'body' =>  $reports->comment,
            'model' =>  'Director Reports',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
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
    public function destroy($id){
        $reports = Reports::find($id);
        if($reports){
            $reports->delete();
        }
        return redirect()->route('reports.index')->with('message', 'Successfully Deleted Report');

    }
}
