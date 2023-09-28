<?php

namespace App\Http\Controllers;

use App\Models\BatchStoreRequest;
use App\Models\GatePass;
use App\Models\Store;
use App\Models\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GatePassController extends Controller
{

    public function index()
    {
        $user = Auth()->user();
        if ($user->can('security')) {
            $gatepasses = GatePass::where('for_security', true)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $gatepasses = GatePass::orderBy('id', 'DESC')->paginate(10);
        }

        return view('dashboard.store.gatepass.index', compact('gatepasses'));
    }
    public function create()
    {
        $store_requests = StoreRequest::latest()->where('status', 'Approved')->get();
        $ApprovedItem = request()->query('ApprovedItem');
        $item_name = StoreRequest::where('id', $ApprovedItem)->get();

        return view('dashboard.store.gatepass.create', compact('store_requests', 'item_name'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'issued_to'             => 'required',
        ]);

        $user = Auth::user();
        $gatepass = new GatePass();
        // General fields
        $gatepass->date = $request->input('date');
        $gatepass->issued_to = $request->input('issued_to');
        $gatepass->start = $request->input('date');
        $gatepass->end = $request->input('date');
        $background_colors = array('#028336', '#ad2323', '#b1a514');
        $rand_background = $background_colors[array_rand($background_colors)];
        $gatepass->color = $rand_background;
        // story fields
        $item_name = $request->item_name;
        $description = $request->description;
        $unit = $request->unit;
        $qty = $request->qty;
        $remarks = $request->remarks;


        for ($count = 0; $count < count($item_name); $count++) {
            $data = array(
                'item_name' => $item_name[$count],
                'description' => $description[$count],
                'unit' => $unit[$count],
                'qty' => $qty[$count],
                'remarks' => $remarks[$count]
            );
            $insert_data[] = $data;
        }
        $gatepass->items = json_encode($insert_data);
        $gatepass->user_id = $user->id;
        $gatepass->save();

        $cc_emails = DB::select('SELECT email from users WHERE department_id = 11 OR department_id = 7 OR department_id = 13');
        $details = [
            'email' => $gatepass->user->email,
            'title' => $gatepass->user->name,
            'status' =>  $gatepass->date,
            'body' =>  $gatepass->purpose,
            'model' =>  'Gate Pass ',
            'user' => $user->name,
            'time' => date('d-m-Y'),
            'cc_emails' => $cc_emails
        ];
        // Event::dispatch(new RecordCreatedEvent($details));
        $request->session()->flash('message', 'Successfully created Gatepass');
        return redirect()->route('gatepass.index');
    }


    public function show(GatePass $gatePass)
    {
        //
    }


    public function edit(GatePass $gatePass)
    {
        //
    }

    public function update(Request $request, GatePass $gatePass)
    {
        //
    }

    public function printPass(Request $request, $id)
    {
        $gatepass = GatePass::find($id);
        $user = Auth::user();

        $json = $gatepass->items;
        $items = json_decode($json, false);


        $date_time = Carbon::now()->setTimezone('Africa/Lagos')->toRfc850String();
        $data = [
            'gatepass_id' => $gatepass->batch_id,
            'issued_to' => $gatepass->user->name,
            'email' => $gatepass->user->email,
            'model' =>  'GatePass',
            'user' => $user->name,
            'department' => $gatepass->department->name,
            'time' => $date_time,
            'from' => Carbon::parse($gatepass->created_at)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'to' => Carbon::parse($gatepass->return_date)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'location' => $gatepass->location
        ];
        // Event::dispatch(new RecordUpdatedEvent($details));


        //  $pdf = PDF::loadView('pdf.gatepass', $data);
        //return $pdf->stream('gatepass'.$date_time.'pdf');
        return view('pdf.gatepass', compact('data', 'items', 'gatepass'));
    }

    public function printPassFromApproved(Request $request, $id)

    {
        $store_request = StoreRequest::find($id);
        $user = Auth::user();
        $date_time = Carbon::now()->setTimezone('Africa/Lagos')->toRfc850String();

        $pass_id = $store_request->id . $user->id . $user->department_id;

        $issued_to = $store_request->user->name;
        $data = [
            'gatepass_id' => $pass_id,
            'issued_to' => $issued_to,
            'email' => $user->email,
            'model' =>  'Store Requests',
            'user' => $user->name,
            'department' => $store_request->user->department->name,
            'time' => $date_time,
            'item' => $store_request->item,
            'description' => "$store_request->item requested by : $issued_to",
            'unit' => $user->department->name,
            'qty'  => "1",
            'from' => Carbon::parse($date_time)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'to' => Carbon::parse($store_request->return_date)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'location' => $store_request->location

        ];
        $gatepass = GatePass::firstOrNew(['pass_id' =>  $pass_id]);
        $gatepass->items = Store::find($store_request->store_id)->first();

        $gatepass->pass_id = $pass_id;
        // dd($pass_id);
        $gatepass->data = json_encode($data);
        $gatepass->user_id = $store_request->user_id;
        $gatepass->department_id = $store_request->department_id;
        $gatepass->return_date = $store_request->return_date;
        $gatepass->status = $store_request->status;
        $gatepass->for_security = $request->input('for_security') ?? 0;
        if ($gatepass->print_count >= 1) {

            $gatepass->print_count += 1;
        }
        $gatepass->batch_id = null;
        $gatepass->save();

        // Event::dispatch(new RecordUpdatedEvent($details));



        //  $pdf = PDF::loadView('pdf.gatepass', $data);
        //return $pdf->stream('gatepass'.$date_time.'pdf');
        return view('pdf.pass-approved', compact('data'));
    }
    public function printPassFromBatchRequest(Request $request, $id)
    {
        $user = Auth::user();
        $batch = BatchStoreRequest::find($id);
        // dd($batch);
        $json = $batch->items;
        $items = json_decode($json, false);

        $date_time = Carbon::now()->setTimezone('Africa/Lagos')->toRfc850String();
        $data = [
            'gatepass_id' => $batch->batch_id,
            'issued_to' => $batch->user->name,
            'email' => $batch->user->email,
            'model' =>  'GatePass',
            'user' => $user->name,
            'department' => $batch->department->name,
            'time' => $date_time,
            'from' => Carbon::parse($date_time)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'to' => Carbon::parse($batch->return_date)->setTimezone('Africa/Lagos')->format('d-M-Y'),
            'location' => $batch->location,
        ];
        $gatepass = GatePass::firstOrNew(['batch_id' =>  $batch->batch_id]);
        $gatepass->items = $batch->items;
        $gatepass->data = json_encode($data);
        $gatepass->user_id = $batch->user_id;
        $gatepass->department_id = $batch->department_id;
        $gatepass->return_date = $batch->return_date;
        $gatepass->status = $batch->status;
        $gatepass->for_security = $request->input('for_security');
        if ($gatepass->print_count >= 1) {

            $gatepass->print_count += 1;
        }
        $gatepass->batch_id = $batch->batch_id;
        $gatepass->save();

        // Event::dispatch(new RecordUpdatedEvent($details));


        //  $pdf = PDF::loadView('pdf.gatepass', $data);
        //return $pdf->stream('gatepass'.$date_time.'pdf');
        return view('pdf.gatepass', compact('data', 'items', 'gatepass'));
    }
    public function destroy(GatePass $gatePass)
    {
        //
    }
}
