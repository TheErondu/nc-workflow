<?php

namespace App\Http\Controllers;

use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Exports\ExportBatchRequests;
use App\Helpers\MailingLists;
use App\Models\BatchStoreRequest;
use App\Models\Department;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class BatchStoreRequestsController extends Controller
{


    public function showBatchRequestEditPage($id)
    {
        $user = Auth()->user();
        $departments = Department::all();
        $batch_store_request = BatchStoreRequest::find($id);
        $json = $batch_store_request->items;
        $requestedBatchExists = DB::table('batch_store_requests')
        ->whereIn('channel', [$user->assigned_channels])
        ->exists();
        if ($user->can('borrower')) {
            $batchRequestItems = collect(json_decode($json, false))->pluck('id');
            $items = Store::find($batchRequestItems)->where('state', 'In circulation');
        } else {
            $batchRequestItems = collect(json_decode($json, false))->pluck('id');
            $items = Store::find($batchRequestItems);
        }


        return view('dashboard.store.requests.batch-edit', compact('departments', 'items', 'batch_store_request','requestedBatchExists'));
    }

    public function submitBatchRequest(Request $request)
    {
        $admin = auth()->user();
        $onBehalfOfId = $request->input('on_behalf_of_user_id');

        // Admin submitting on behalf of another user
        if ($admin->hasRole('Admin') && $onBehalfOfId) {
            $user = User::findOrFail($onBehalfOfId);
        } else {
            $user = $admin;
        }

        $batch_store_request = new BatchStoreRequest();
        $batch = explode(",", $request->input('item_ids'));
        if ($batch == null) {
            return redirect()->back()->withErrors(['No item selected!']);
        } else {
            Store::whereIn('id', $batch)->update(['state' => Store::is_borrowed]);
            $updatedItems = Store::whereIn('id', $batch)->get()->keyBy('id');
            $allRequestedItems = collect($batch)
                ->map(fn ($id) => $updatedItems->get($id)->attributesToArray())
                ->all();

            $batch_store_request->items = json_encode($allRequestedItems);
            $batch_store_request->user_id = $user->id;
            $batch_store_request->return_date = $request->input('return_date');
            $batch_store_request->department_id = $user->department_id;
            $batch_store_request->channel = $request->input('channel');
            $batch_store_request->batch_id = "$user->id" . date('Ymdhi');
            $batch_store_request->location = $request->input('location');
            $cc_emails = MailingLists::addEmailsToCc($batch_store_request);
            $batch_store_request->save();
            Session::remove('allRequestedItems');
            $cc_emails = MailingLists::addEmailsToCc($batch_store_request);
            $link = route('store.requests.batch.edit', ['batch_id' => $batch_store_request->id]);
            $submittedBy = ($user->id !== $admin->id) ? " (submitted by {$admin->name})" : '';
            $details = [
                'cc_emails' => $cc_emails,
                'email' => $user->email,
                'title' => $user->name . ' has made a new store request.' . $submittedBy,
                'return date' => $batch_store_request->return_date,
                'body' => $user->name . ' has requested some items from the store. Please click the link below to see details of this request and take action.',
                'model' => 'Store Requests',
                'user' => $admin->name,
                'time' => date('d-m-Y'),
                'link' => $link,
            ];
            Event::dispatch(new RecordCreatedEvent($details));
            return redirect()->route('store-requests.index')->with('message', 'Batch request was sent successfully!');
        }
    }

    public function repeatBatchRequest(Request $request, $id)
    {

        $user = auth()->user();
        $batch_store_request = BatchStoreRequest::find($id);
        $batch = collect(json_decode($batch_store_request->items))->pluck('id');
        $items = Store::find($batch)->where('state', Store::is_in_circulation);
        $ids = $items->pluck('id');
        Store::whereIn('id', $ids)->update(['state' => 3]);
        $updatedItems = Store::whereIn('id', $ids)->get()->keyBy('id');
        $allRequestedItems = $ids
            ->map(fn ($id) => $updatedItems->get($id)->attributesToArray())
            ->all();


        $new_batch_store_request = new BatchStoreRequest();
        $new_batch_store_request->items = json_encode($allRequestedItems);
        $new_batch_store_request->user_id = $user->id;
        $new_batch_store_request->return_date = $request->input('return_date');
        $new_batch_store_request->department_id = $user->department_id;
        $batch_store_request->channel = $request->input('channel');
        $new_batch_store_request->batch_id = "$user->id" . date('Ymdhi');
        $new_batch_store_request->save();
        $link = route('store.requests.batch.edit', ['batch_id' => $new_batch_store_request->batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($new_batch_store_request);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $user->name . 'has requested items from the store',
            'status' => $batch_store_request->return_date,
            'body' => $batch_store_request->assigned_department,
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link,
        ];
        Event::dispatch(new RecordCreatedEvent($details));

        return redirect()->route('store.requests.index')->with('message', 'Batch successfully added from store!');
    }

    public function approveBatchRequest(Request $request)
    {
        $batch_id = $request->input('batch_id');
        $batchRequest = BatchStoreRequest::with('user')->where('batch_id', $batch_id)->first();
        $batchRequest->update([
            'status' => 'approved'
        ]);
        $link = route('store.requests.batch.edit', ['batch_id' => $batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);

        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->return_date,
            'body' => 'Batch request status has been changed to approved',
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link,
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('store.index')->with('message', 'Batch Request status has been changed to Approved!');
    }

    public function checkBatchRequest(Request $request): \Illuminate\Http\RedirectResponse
    {
        $batch_id = $request->input('batch_id');
        $batchRequest = BatchStoreRequest::with('user')->where('batch_id', $batch_id)->first();
        $batchRequest->update([
            'status' => 'checked'
        ]);
        $link = route('store.requests.batch.edit', ['batch_id' => $batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->return_date,
            'body' => 'Batch request status has been changed to checked',
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('store.index')->with('message', 'Batch Request status has been changed to Checked!');
    }

    public function releaseBatchRequest(Request $request)
    {
        $batch_id = $request->input('batch_id');
        $batchRequest = BatchStoreRequest::with('user')->where('batch_id', $batch_id)->first();
        $batchRequest->update([
            'status' => 'released'
        ]);
        $link = route('store.requests.batch.edit', ['batch_id' => $batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->return_date,
            'body' => $batchRequest->department->name,
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('store.index')->with('message', 'Batch Request status has been changed to Approved!');
    }

    public function rejectBatchRequest(Request $request)
    {
        $batch_id = $request->input('batch_id');
        $batchRequest = BatchStoreRequest::with('user')->where('batch_id', $batch_id)->first();
        $batchRequest->status = "rejected";
        $batchRequest->rejection_comment = $request->input('rejection_comment');
        $batchRequest->save();

        $rejectedIds = collect(json_decode($batchRequest->items, false))->pluck('id');
        Store::whereIn('id', $rejectedIds)->update(['state' => Store::is_in_circulation]);
        $link = route('store.requests.batch.edit', ['batch_id' => $batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->rejection_comment,
            'body' => 'Your batch request was rejected due to the following reasons: ',
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link,
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('store.index')->with('message', 'Batch Request  status has  been changed to Rejected!');
    }


    public function returnBatchRequest(Request $request)
    {
        $batch_id = $request->input('batch_id');
        $batchRequest = BatchStoreRequest::with('user')->where('batch_id', $batch_id)->first();
        $batchRequest->update([
            'status' => 'returned'
        ]);
        $returnedIds = collect(json_decode($batchRequest->items, false))->pluck('id');
        Store::whereIn('id', $returnedIds)->update(['state' => Store::is_in_circulation]);
        $link = route('store.requests.batch.edit', ['batch_id' => $batch_id]);
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->return_date,
            'body' => 'Batch request status has been changed to returned',
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y'),
            'link' => $link
        ];
        Event::dispatch(new RecordUpdatedEvent($details));

        return redirect()->route('store.index')->with('message', 'Batch Request returned');
    }


    public function extendBatchRequestReturnDate(Request $request, $id)
    {
        $batchRequest = BatchStoreRequest::find($id);
        if ($request->input('action') == "approve") {
            $batchRequest->date_extension_status = 2;
        } elseif ($request->input('action') == "check") {

            $batchRequest->date_extension_status = 3;
        } elseif ($request->input('action') == "release") {
            $batchRequest->date_extension_status = 0;
            $batchRequest->return_date = $batchRequest->extended_date;
        } else {
            $batchRequest->date_extension_status = 1;
        }
        $batchRequest->extended_date = Carbon::parse($request->input('extension_date'))->format('Y-m-d');
        $batchRequest->date_extension_reason = $request->input('date_extension_reason');
        $batchRequest->save();
        $cc_emails = MailingLists::addEmailsToCc($batchRequest);
        $details = [
            'cc_emails' => $cc_emails,
            'email' => Auth::user()->email,
            'title' => $batchRequest->user->name,
            'status' => $batchRequest->return_date,
            'body' => $batchRequest->department->name,
            'model' => 'Store Requests',
            'user' => auth()->user()->name,
            'time' => date('d-m-Y')
        ];
        Event::dispatch(new RecordUpdatedEvent($details));
        if ($request->input('action') == "approve") {
            return redirect()->back()->with('message', 'Request  Approved');
        }
        if ($request->input('action') == "check") {
            return redirect()->back()->with('message', 'Request  Checked');
        }
        if ($request->input('action') == "release") {
            return redirect()->back()->with('message', 'Request  Released');
        } else {
            return redirect()->route('store.requests.index')->with('message', 'Extension Request sent!');
        }
    }

    public function showGenerateReportPage()
    {
        $reports = BatchStoreRequest::all();
        $statuses = Store::statuses();
        return view('dashboard.store.reports.index', compact('reports', 'statuses'));
    }

    public function generateReport(Request $request)
    {
        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = BatchStoreRequest::query();

        if (!is_null($status)) {
            $query->where('status', $status);
        }

        if (!is_null($start_date)) {
            $query->where('created_at', '>=', $start_date);
        }

        if (!is_null($end_date)) {
            $query->where('created_at', '<=', $end_date);
        }

        $report = $query->get();
        return view('pdf.batch_request_reports', compact('report'));
    }

}
