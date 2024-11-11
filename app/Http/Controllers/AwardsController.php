<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $awards = Awards::all()->where('type','award');
        $shows = Awards::all()->where('type','show');
        $teams = Awards::all()->where('type','team');
        return view('dashboard.awards.index', compact('awards','shows','teams'));
    }


    public function showLiveResults(){
        return view('dashboard.awards.voting.showLiveResults');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createShow()
    {
        $awards = Awards::all();
        return view('dashboard.awards.create.show',[ 'awards' => $awards ]);
    }
    public function createAward()
    {
        $awards = Awards::all();
        return view('dashboard.awards.create.award',[ 'awards' => $awards ]);
    }
    public function createTeam()
    {
        $awards = Awards::all();
        return view('dashboard.awards.create.team',[ 'awards' => $awards ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $awards = new Awards();
        $awards->type     = $request->input('type');
        $awards->show_title     = $request->input('show_title');
        $awards->showing_time = $request->input('showing_time');
        $awards->show_location = $request->input('show_location');
        if($request->file('photo')){
            $awards->photo   = $request->file('photo')->store('/', 'media');
            }
        $awards->name = $request->input('name');
        $awards->description = $request->input('description');
        if($request->file('picture')){
            $awards->picture   = $request->file('picture')->store('/','media');
            }
        $awards->fullname1 = $request->input('fullname1');
        $awards->fullname2 = $request->input('fullname2');
        if($request->file('image1')){
            $awards->image1   = $request->file('image1')->store('/','media');
            }
            if($request->file('image2')){
                $awards->image2   = $request->file('image2')->store('/','media');
                }
        $awards->description = $request->input('description');
        $awards->save();
        $request->session()->flash('message', 'Successfully created award');
        return redirect()->route('awards.index');
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

        $awards = Awards::find($id);

        $awards->show_title     = $request->input('show_title');
        $awards->showing_time = $request->input('showing_time');
        $awards->show_location = $request->input('show_location');
        if($request->file('photo')){
            $awards->photo   = $request->file('photo')->store('/', 'media');
            }
        $awards->name = $request->input('name');
        $awards->description = $request->input('description');
        if($request->file('picture')){
            $awards->picture   = $request->file('picture')->store('/files');
            }
        $awards->fullname1 = $request->input('fullname1');
        $awards->fullname2 = $request->input('fullname2');
        if($request->file('image1')){
            $awards->image1   = $request->file('image1')->store('/files');
            }
            if($request->file('image2')){
                $awards->image2   = $request->file('image2')->store('/files');
                }
        $awards->description = $request->input('description');
        $awards->save();
        $request->session()->flash('message', 'Successfully created award');
        return redirect()->route('awards.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Humans  $humans
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $awards = Awards::find($id);
        if($awards){
            $awards->delete();
        }
        return redirect()->route('booking.index')->with('message', 'Booking Deleted');

    }
}
