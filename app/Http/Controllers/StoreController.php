<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Department;
use App\Models\StoreRequest;
use Illuminate\Http\Request;

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
        $store_requests = StoreRequest::all();
        return view('dashboard.store.index', compact('store_items','store_requests'));
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
    public function createRequest()
    {

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
        $store_item->save();
        $request->session()->flash('message', 'Successfully added Item to the store!');
        return redirect()->route('store.index');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRequest(Request $request)
    {
        //
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
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function editRequest(Store $store)
    {
        //
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
        $request->session()->flash('message', 'Successfully Updated Item!');
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
        $store_item = Reports::find($id);
        if($store_item){
            $store_item->delete();
        }
        return redirect()->route('store.index')->with('message', 'Successfully Deleted Report');
    }
}
