<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Response $id)
    {
        $welcome_message = Message::all()->where('type','message')->sortByDesc('id', 0)->first();
        $notifications = Message::all()->where('type','notification');
        return view('dashboard.messages.index',compact('welcome_message','notifications'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id) {
        // retreive all records from db

        $message = Message::all()->find($id);

        return Storage::download($message->file,$message->filename);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $messages = Message::all();
        return view('dashboard.messages.create',[ 'messsages' => $messages ]);
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
            'file.*' => 'required|in:csv,doc,jpg,jpeg,txt,xlx,xls,pdf|max:2048',
            'filename'           => '',
            'message'           => '',
            'type'           => 'required',
        ]);
        $user = Auth::user();
        $message = new Message();
        $message->title     = $request->input('title');
        if($request->file('file')){
        $message->file   = $request->file('file')->store('public/files');
        $message->filename = $request->file('file')->getClientOriginalName();
        }
        $message->message = $request->input('message');
        $message->type = $request->input('type');
        $message->user_id = $user->id;
        $message->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $user->email,
            'title' => $message->name,
            'status' =>  $message->type,
            'body' =>  $message->location,
            'model' =>  'Employees',
            'user' => $user->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created message');
        return redirect()->route('messages.create');
    }

   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $message = Message::with('user')->find($id);

        return view('dashboard.message.show', [ 'message' => $message ]);



    }
/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = message::all()->find($id);
        return view('dashboard.messages.edit', [ 'message' => $message,]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title'             => 'required',
            'file.*' => 'required|in:csv,doc,jpg,jpeg,txt,xlx,xls,pdf|max:2048',
            'filename'           => '',
            'message'           => '',
            'type'           => 'required',
        ]);
        $message = Message::find($id);
        $user = Auth::user();
        $message->title     = $request->input('title');
        if($request->file('file')){
        $message->file   = $request->file('file')->store('public/files');
        $message->filename = $request->file('file')->getClientOriginalName();
        }
        $message->message = $request->input('message');
        $message->type = $request->input('type');
        $message->user_id = $user->id;
        $message->save();
        $request->session()->flash('message', 'Changes have been saved!');
        return redirect()->route('messages.edit',$message->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
