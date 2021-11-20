<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Facility;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        return view('dashboard.booking.index');
    }


    public function create()
    {
        $bookings = Booking::all();
        $studios = Facility::all()->where('type','=','Studio');
        $boardrooms = Facility::all()->where('type','=','BoardRoom');
        return view('dashboard.booking.create',compact('studios','boardrooms'));
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
            'title'           => 'required',
            'date'           => 'required',
            'start_time'           => 'required',
            'end_time'           => 'required',
            'type'           => 'required',
            'facility'           => 'required',
            'description'           => 'required',


        ]);
        $user = auth()->user();
        $booking = new Booking();
        $booking->title = $request->input('title');
        $booking->date = $request->input('date');
        $booking->start = $request->input('start');
        $booking->end = $request->input('end');
        $booking->type = $request->input('type');
        $booking->facility = $request->input('facility');
        $booking->description = $request->input('description');
        $booking->user_id = $user->id;
        $booking->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $booking->title,
            'status' =>  $booking->status,
            'body' =>  $booking->description,
            'model' =>  'Booking',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Success!');
        $type = $request->input('type');
        return redirect()->route('booking.index', ['type'=> $type]);
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $booking = Booking::all()->find($id);

        return view('dashboard.booking.show', [ 'booking' => $booking ]);



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::all()->find($id);
        $countries = Country::all();
        return view('dashboard.booking.edit', [ 'booking' => $booking,'countries' =>$countries]);
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
            'title'           => 'required',
            'date'           => 'required',
            'end'           => 'required',
            'start'           => 'required',
            'end'           => 'required',
            'delivery_date'           => 'required',
            'type'           => 'required',
            'facility'           => 'required',
            'description'           => 'required',


        ]);
        $booking = Booking::find($id);
        $booking->title = $request->input('title');
        $booking->date = $request->input('date');
        $booking->start = $request->input('start');
        $booking->end = $request->input('end');
        $booking->type = $request->input('type');
        $booking->facility = $request->input('facility');
        $booking->description = $request->input('description');
        $booking->save();
        $request->session()->flash('message', 'Success!');
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'title' => $booking->title,
            'status' =>  $booking->status,
            'body' =>  $booking->deescription,
            'model' =>  'Booking',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $type = $request->input('type');
        return redirect()->route('booking.index', ['type'=> $type]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $booking = Booking::find($id);
        if($booking){
            $booking->delete();
        }
        return redirect()->route('booking.index')->with('message', 'Booking Deleted');

    }
}

