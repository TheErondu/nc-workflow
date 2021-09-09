<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;
use App\Models\Country;

class ContentController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Content::whereDate('start_date', '>=', $request->start)
                ->whereDate('end_date',   '<=', $request->end)
                ->get(['id', 'name', 'start_date', 'end_date', 'type']);
            return response()->json($data);
        }
        return view('dashboard.content.index');
    }


    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = Content::create([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = Content::find($request->id)->update([
                  'name' => $request->name,
                  'start_date' => $request->start_date,
                  'end_date' => $request->end_date,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Content::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }

    public function create()
    {
        $contents = Content::all();
        $countries = Country::all();
        return view('dashboard.content.create',[ 'contents' => $contents, 'countries' => $countries ]);
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
            'title'             => 'required',
            'team_lead'           => 'required',
            'genre'           => 'required',
            'start'           => 'required',
            'end'           => 'required',
            'delivery_date'           => 'required',
            'country'           => 'required',
            'location'           => 'required',
            'status'           => 'required',
            'distribution_platform'           => 'required',
            'project_brief'           => 'required',


        ]);
        $user = auth()->user();
        $content = new Content();
        $content->title = $request->input('title');
        $content->team_lead = $request->input('team_lead');
        $content->genre = $request->input('genre');
        $content->start = $request->input('start');
        $content->end = $request->input('end');
        $content->delivery_date = $request->input('delivery_date');
        $content->country = $request->input('country');
        $content->location = $request->input('location');
        $content->status = $request->input('status');
        $content->distribution_platform = $request->input('distribution_platform');
        $content->project_brief = $request->input('project_brief');
        $content->user_id = $user->id;
        $content->save();
        $request->session()->flash('message', 'Successfully created Project!');
        return redirect()->route('content.index');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $content = Content::all()->find($id);

        return view('dashboard.content.show', [ 'content' => $content ]);



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::all()->find($id);
        $countries = Country::all();
        return view('dashboard.content.edit', [ 'content' => $content,'countries' =>$countries]);
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
        //var_dump('bazinga');
        //die();
        $validatedData = $request->validate([
            'title'             => 'required',
            'team_lead'           => 'required',
            'genre'           => 'required',
            'start'           => 'required',
            'end'           => 'required',
            'delivery_date'           => 'required',
            'country'           => 'required',
            'location'           => 'required',
            'status'           => 'required',
            'distribution_platform'           => 'required',
            'project_brief'           => 'required',


        ]);
        $content = Content::find($id);
        $user = auth()->user();
        $content->title = $request->input('title');
        $content->team_lead = $request->input('team_lead');
        $content->genre = $request->input('genre');
        $content->start = $request->input('start');
        $content->end = $request->input('end');
        $content->delivery_date = $request->input('delivery_date');
        $content->country = $request->input('country');
        $content->location = $request->input('location');
        $content->status = $request->input('status');
        $content->distribution_platform = $request->input('distribution_platform');
        $content->project_brief = $request->input('project_brief');
        $content->user_id = $user->id;
        $content->save();
        $request->session()->flash('message', 'Successfully created Project!');
        return redirect()->route('content.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $content = Content::find($id);
        if($content){
            $content->delete();
        }
        return redirect()->route('content.index')->with('message', 'Project Deleted');

    }
}

