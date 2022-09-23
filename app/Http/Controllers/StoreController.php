<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Models\Store;
use App\Models\Department;
use App\Models\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_items = Store::all();
        $store_requests = StoreRequest::all()->where('status','pending');
        $approved_items =StoreRequest::all()->where('status','Approved');
        return view('dashboard.store.index', compact('store_items','store_requests','approved_items'));
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function RequestIndex()
    {
        $user_department = Auth::user()->department->name;
        $user = auth()->user();
        $available_items = Store::all()->where('assigned_department', $user_department);
        $all_requested = DB::select("SELECT * FROM `store_requests` WHERE status != 'Pending' AND user_id = $user->id");
        $requested_items = StoreRequest::all()->where('status', 'pending')->where('user_id',$user->id);
        $store_requests = StoreRequest::all();
        return view('dashboard.store.requests.index', compact('available_items','store_requests','requested_items','all_requested'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('dashboard.store.items.create',compact('departments'));
    }

     /**
     * Show the form for creating a new resource.
     *@param int $id
     * @return \Illuminate\Http\Response
     */
    public function createRequest($id)
    {   $requested_item = Store::all()->find($id);
        $store_items = Store::all();
        $store_requests = StoreRequest::all();
        return view('dashboard.store.requests.create', compact('store_items','store_requests','requested_item'));
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
            'item_name'             => 'required',
            'serial_no'             => 'required',
            'assigned_department'           => 'required',
            'state'           => 'required'
        ]);
        $store_item = new Store();
        $store_item->item_name = $request->input('item_name');
        $store_item->serial_no = $request->input('serial_no');
        $store_item->assigned_department = $request->input('assigned_department');
        $store_item->state = $request->input('state');
        $email = Auth::user()->email;
        $store_item->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $email,
            'title' => $store_item->item_name,
            'status' =>  $store_item->state,
            'body' =>  $store_item->assigned_department,
            'model' =>  'Store Item',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully added Item to the store!');
        return redirect()->route('store.index');
    }

     /**
     * Store a newly created resource in storage.
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRequest(Request $request, $id)
    {
        $validatedData = $request->validate([
            'return_date'           => 'required',
        ]);
        $user = auth()->user();
        $requested_item = Store::all()->find($id);
        $store_requests = new storeRequest();
        $store_requests->user_id = $user->id;
        $store_requests->item = $requested_item->item_name;
        $store_requests->store_id = $requested_item->id;
        $store_requests->return_date = $request->input('return_date');
        $store_requests->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $store_requests->item,
            'status' =>  $store_requests->return_date,
            'body' =>  $store_requests->assigned_department,
            'model' =>  'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Item successfully requested from store!');
        return redirect()->route('store-requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editRequest(Request $request, $id)
    {
        $departments = Department::all();
        $store_request = storeRequest::all()->find($id);
        return view('dashboard.store.requests.edit',compact('departments','store_request'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $store_item = Store::all()->find($id);
        return view('dashboard.store.items.edit',compact('departments','store_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'item_name'             => 'required',
            'serial_no'             => 'required',
            'assigned_department'           => 'required',
            'state'           => 'required'
        ]);
        $store_item = Store::find($id);
        $store_item->item_name = $request->input('item_name');
        $store_item->serial_no = $request->input('serial_no');
        $store_item->assigned_department = $request->input('assigned_department');
        $store_item->state = $request->input('state');
        $store_item->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $store_item->item_name,
            'status' =>  $store_item->state,
            'body' =>  $store_item->assigned_department,
            'model' =>  'Store Item',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Successfully Updated Item!');
        return redirect()->route('store.index');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Approve(Request $request, $id)
    {
        $store_request = StoreRequest::all()->find($id);
        $store_request->status = "Approved";
        $store_request->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $store_request->user->email,
            'title' => $store_request->item_name,
            'status' =>  $store_request->status,
            'body' =>  $store_request->assigned_department,
            'model' =>  'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Request Approved !');
        return redirect()->route('store.index');

    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Reject(Request $request, $id)
    {
        $store_request = StoreRequest::all()->find($id);
        $store_request->status = "Rejected";
        $store_request->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $store_request->user->email,
            'title' => $store_request->item_name,
            'status' =>  $store_request->status,
            'body' =>  $store_request->assigned_department,
            'model' =>  'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Request Rejected !');
        return redirect()->route('store.index');

    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Return(Request $request, $id)
    {
        $store_request = StoreRequest::all()->find($id);
        $store_request->status = "Returned";
        $store_request->save();
        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11');
        $details = [
            'cc_emails' => $cc_emails,
            'email' => $store_request->user->email,
            'title' => $store_request->item_name,
            'status' =>  $store_request->status,
            'body' =>  $store_request->assigned_department,
            'model' =>  'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        $request->session()->flash('message', 'Requested Item has been marked as Returned !');
        return redirect()->route('store.index');

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function updateRequest(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store_item = Store::find($id);
        if($store_item){
            $store_item->delete();
        }
        return redirect()->route('store.index')->with('message', 'Successfully Deleted Request');
    }
}
