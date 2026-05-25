<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::Routes();
Route::get('signage/show/{screen:name}', [App\Http\Controllers\SignageController::class, 'show'])->name('signage.show');
Route::get('signage/screens', [App\Http\Controllers\SignageController::class, 'getScreensList'])->name('signage.screens.list');
Route::get('awards/voting/results', [App\Http\Controllers\AwardsController::class, 'showLiveResults'])->name('awards.voting.results');

Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('dumplogs', 'App\Http\Controllers\COTController@DumpLogs');
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::post('permissions/store', 'App\Http\Controllers\PermissionController@store')->name('permissions.store');
    Route::put('employees/password/reset/{id}', [App\Http\Controllers\EmployeeController::class, 'resetpass'])->name('employees.reset');
});
Route::get('/offline', function () {
    return response()->file(public_path('offline.html'));
})->name('offline');

Route::group(['middleware' => ['auth']], function () {
    Route::post('push/subscribe', [App\Http\Controllers\PushController::class, 'subscribe'])->name('push.subscribe');
    Route::post('push/unsubscribe', [App\Http\Controllers\PushController::class, 'unsubscribe'])->name('push.unsubscribe');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::resource('messages', 'App\Http\Controllers\MessageController');
    Route::get('messages/{id}/download', 'App\Http\Controllers\MessageController@download')->name('file.download');
    Route::resource('content', 'App\Http\Controllers\ContentController');
    Route::resource('sales-production', 'App\Http\Controllers\SalesScheduleController');
    Route::resource('maintenance-schedule', 'App\Http\Controllers\MaintenanceSchedulerController');
    Route::resource('documents', 'App\Http\Controllers\DocumentController');
    Route::resource('dutylog', 'App\Http\Controllers\DutyloggerController');
    Route::resource('reports', 'App\Http\Controllers\ReportsController');
    Route::resource('oblogs', 'App\Http\Controllers\OBlogsController');
    Route::resource('schedule', 'App\Http\Controllers\ScheduleController');
    // Signage Admin Routes
    Route::get('signage/admin', [App\Http\Controllers\SignageController::class, 'index'])->name('signage.admin');
    Route::get('signage/admin/screens/create', [App\Http\Controllers\SignageController::class, 'showCreateScreenPage'])->name('signage.admin.screens.create');
    Route::post('signage/admin/screens', [App\Http\Controllers\SignageController::class, 'createScreen'])->name('signage.admin.screens.store');
    Route::get('signage/admin/screens/{screen}/edit', [App\Http\Controllers\SignageController::class, 'editScreen'])->name('signage.admin.screens.edit');
    Route::put('signage/admin/screens/{screen}', [App\Http\Controllers\SignageController::class, 'updateScreen'])->name('signage.admin.screens.update');
    Route::delete('signage/admin/screens/{screen}', [App\Http\Controllers\SignageController::class, 'destroyScreen'])->name('signage.admin.screens.destroy');

    // Signage Birthdays Routes (Calendar-based CRUD)
    Route::get('signage/admin/birthdays', [App\Http\Controllers\SignageSlideController::class, 'birthdaysIndex'])->name('signage.birthdays.index');
    Route::get('signage/admin/birthdays/calendar', [App\Http\Controllers\SignageSlideController::class, 'birthdayCalendarEvents'])->name('signage.birthdays.calendar');
    Route::get('signage/admin/birthdays/create', [App\Http\Controllers\SignageSlideController::class, 'birthdaysCreate'])->name('signage.birthdays.create');
    Route::post('signage/admin/birthdays', [App\Http\Controllers\SignageSlideController::class, 'birthdaysStore'])->name('signage.birthdays.store');
    Route::get('signage/admin/birthdays/{slide}/edit', [App\Http\Controllers\SignageSlideController::class, 'birthdaysEdit'])->name('signage.birthdays.edit');
    Route::put('signage/admin/birthdays/{slide}', [App\Http\Controllers\SignageSlideController::class, 'birthdaysUpdate'])->name('signage.birthdays.update');
    Route::delete('signage/admin/birthdays/{slide}', [App\Http\Controllers\SignageSlideController::class, 'birthdaysDestroy'])->name('signage.birthdays.destroy');

    // Signage Slides Routes (Table-based CRUD for non-birthday slides)
    Route::get('signage/admin/slides', [App\Http\Controllers\SignageSlideController::class, 'index'])->name('signage.slides.index');
    Route::get('signage/admin/slides/create', [App\Http\Controllers\SignageSlideController::class, 'create'])->name('signage.slides.create');
    Route::post('signage/admin/slides', [App\Http\Controllers\SignageSlideController::class, 'store'])->name('signage.slides.store');
    Route::get('signage/admin/slides/{slide}/edit', [App\Http\Controllers\SignageSlideController::class, 'edit'])->name('signage.slides.edit');
    Route::put('signage/admin/slides/{slide}', [App\Http\Controllers\SignageSlideController::class, 'update'])->name('signage.slides.update');
    Route::delete('signage/admin/slides/{slide}', [App\Http\Controllers\SignageSlideController::class, 'destroy'])->name('signage.slides.destroy');
    Route::post('signage/admin/slides/{slide}/move-up', [App\Http\Controllers\SignageSlideController::class, 'moveUp'])->name('signage.slides.move-up');
    Route::post('signage/admin/slides/{slide}/move-down', [App\Http\Controllers\SignageSlideController::class, 'moveDown'])->name('signage.slides.move-down');

    //Engineer logs

    Route::get('logs/engineers/calendar', 'App\Http\Controllers\EngineerLogsController@calendarView')->name('logs.engineers.calendar');
    Route::resource('logs/engineers', 'App\Http\Controllers\EngineerLogsController')->except('delete');
    Route::delete('/logs/engineers{id}/delete', 'App\Http\Controllers\EngineerLogsController@destroy')->name('logs.engineers.delete');

    Route::resource('appointments', 'App\Http\Controllers\AppointmentController');


    Route::get('calendar-event', [App\Http\Controllers\ScheduleController::class, 'index']);
    Route::post('calendar-crud-ajax', [App\Http\Controllers\ScheduleController::class, 'calendarEvents']);
    Route::resource('documents', 'App\Http\Controllers\DocumentController');
    Route::resource('awards', 'App\Http\Controllers\AwardsController');
    Route::get('show-of-the-week/new', 'App\Http\Controllers\AwardsController@CreateShow');
    Route::get('awardee/new', 'App\Http\Controllers\AwardsController@CreateAward');
    Route::get('team-of-month/new', 'App\Http\Controllers\AwardsController@CreateTeam');
    Route::resource('vehicles', 'App\Http\Controllers\VehicleController');
    Route::get('vehicles/delete/{id}', [App\Http\Controllers\VehicleController::class, 'delete'])->name('delete');
    Route::resource('tracker', 'App\Http\Controllers\TrackerController');
    Route::get('mileage/track/{id}', [App\Http\Controllers\TrackerController::class, 'track'])->name('tracker.track');
    Route::resource('triplogger', 'App\Http\Controllers\TripLoggerController');
    Route::resource('departments', 'App\Http\Controllers\DepartmentController');
    Route::resource('locations', App\Http\Controllers\LocationController::class);

    // Store Excel export routes (must be before resource route to avoid {store} wildcard conflict)
    Route::get('store/export/items', 'App\Http\Controllers\StoreController@exportStoreItems')->name('store.export.items');
    Route::get('store/export/requests/pending', 'App\Http\Controllers\StoreController@exportPendingRequests')->name('store.export.requests.pending');
    Route::get('store/export/requests/approved', 'App\Http\Controllers\StoreController@exportApprovedRequests')->name('store.export.requests.approved');
    Route::get('store/export/batch/pending', 'App\Http\Controllers\StoreController@exportPendingBatchRequests')->name('store.export.batch.pending');
    Route::get('store/export/batch/approved', 'App\Http\Controllers\StoreController@exportApprovedBatchRequests')->name('store.export.batch.approved');

    Route::resource('store', 'App\Http\Controllers\StoreController');
    Route::resource('logs/mcr', 'App\Http\Controllers\McrLogsController');
    Route::resource('logs/sto', 'App\Http\Controllers\StoLogsController')->names('sto-logs');
    Route::resource('logs/audio', 'App\Http\Controllers\AudioLogsController')->names('audio-logs');
    Route::resource('logs/production', 'App\Http\Controllers\ProductionShowLogsController');
    Route::resource('logs/editors', 'App\Http\Controllers\EditorLogsController');
    Route::resource('logs/prompter-news', 'App\Http\Controllers\PrompterLogsController');
    Route::resource('logs/prompter-shows', 'App\Http\Controllers\PrompterLogShowsController');
    Route::resource('logs/graphics-news', 'App\Http\Controllers\GraphicsLogsController');
    Route::resource('logs/graphics-shows', 'App\Http\Controllers\GraphicsLogShowsController');
    Route::resource('logs/transmission', 'App\Http\Controllers\TransmissionReportController');
    Route::resource('logs/cot', 'App\Http\Controllers\COTController');

    ///Batch Store requests

    Route::post('store/requests/batch/add', 'App\Http\Controllers\BatchController@addItems')->name('store.requests.batch.add');
    Route::get('store/requests/batch/add/{id}', 'App\Http\Controllers\BatchController@addSingleItem')->name('store.requests.batch.add.single');

    Route::get('store/requests/batch/clear', 'App\Http\Controllers\BatchController@clearBatch')->name('store.requests.batch.clear');

    Route::get('store/requests/batch/view', 'App\Http\Controllers\BatchController@index')->name('store.requests.batch.view');
    Route::get('store/requests/batch/remove/{id}', 'App\Http\Controllers\BatchController@removeItem')->name('store.requests.batch.remove');

    Route::post('store/requests/batch/store', 'App\Http\Controllers\BatchStoreRequestsController@submitBatchRequest')->name('store.requests.batch.store');

    Route::get('store/requests/batch/{batch_id}', 'App\Http\Controllers\BatchStoreRequestsController@showBatchRequestEditPage')->name('store.requests.batch.edit');

    Route::put('store/requests/batch/repeat/{id}', 'App\Http\Controllers\BatchStoreRequestsController@repeatBatchRequest')->name('store.requests.batch.repeat');

    Route::put('store/requests/batch/{id}/extend', 'App\Http\Controllers\BatchStoreRequestsController@extendBatchRequestReturnDate')->name('store.requests.batch.extend');

    Route::put('store/requests/batch/approve', 'App\Http\Controllers\BatchStoreRequestsController@approveBatchRequest')->name('store.requests.batch.approve');

    Route::put('store/requests/batch/return', 'App\Http\Controllers\BatchStoreRequestsController@returnBatchRequest')->name('store.requests.batch.return');


    //Generate Reports

    Route::get('generate/reports', 'App\Http\Controllers\GenerateReportsController@index')->name('generate.reports.index');
    

    // /GatePass Routes /////

    Route::resource('gatepass', 'App\Http\Controllers\GatePassController');

    Route::post('gatepass/{id}/print', 'App\Http\Controllers\GatePassController@printPassFromApproved')->name('gatepass.print');

    Route::post('gatepass/batch/{id}/print', 'App\Http\Controllers\GatePassController@printPassFromBatchRequest')->name('gatepass.batch.print');

    ///////////////////////////

    Route::put('store/requests/batch/reject', 'App\Http\Controllers\BatchStoreRequestsController@rejectBatchRequest')->name('store.requests.batch.reject');

    Route::get('store-requests', 'App\Http\Controllers\StoreController@RequestIndex')->name('store-requests.index');
    Route::get('store-requests/create/{id}', 'App\Http\Controllers\StoreController@createRequest')->name('store-requests.create');
    // store-requests export routes must be before {id} wildcard
    Route::get('store-requests/export/available', 'App\Http\Controllers\StoreController@exportAvailableItems')->name('store-requests.export.available');
    Route::get('store-requests/export/my-requests', 'App\Http\Controllers\StoreController@exportMyRequests')->name('store-requests.export.my');
    Route::get('store-requests/export/closed', 'App\Http\Controllers\StoreController@exportClosedRequests')->name('store-requests.export.closed');
    Route::post('store-requests/{id}', 'App\Http\Controllers\StoreController@storeRequest')->name('store-requests.store');
    Route::get('store-requests/{id}', 'App\Http\Controllers\StoreController@editRequest')->name('store-requests.edit');
    Route::put('store-requests/approve/{id}', 'App\Http\Controllers\StoreController@Approve')->name('store-requests.approve');
    Route::put('store-requests/reject/{id}', 'App\Http\Controllers\StoreController@Reject')->name('store-requests.reject');
    Route::put('store-requests/return/{id}', 'App\Http\Controllers\StoreController@Return')->name('store-requests.return');
    Route::post('issues/bulk-close', [App\Http\Controllers\IssueController::class, 'bulkClose'])->name('issues.bulk-close');
    Route::get('issues/export', [App\Http\Controllers\IssueController::class, 'export'])->name('issues.export');
    Route::resource('issues', 'App\Http\Controllers\IssueController');
    Route::resource('jobs', 'App\Http\Controllers\QueueJobsController');
    Route::get('job/retry/{id}', 'App\Http\Controllers\QueueJobsController@Retry')->name('job.retry');
    Route::get('jobs/retry/all', 'App\Http\Controllers\QueueJobsController@RetryAll')->name('jobs.retry');
    Route::get('animation', 'App\Http\Controllers\LottieController@index');
    Route::resource('facility', App\Http\Controllers\FacilityController::class);
    Route::resource('cots', App\Http\Controllers\COTController::class);
    Route::resource('facility_type', App\Http\Controllers\FacilityTypeController::class);
    Route::resource('booking', App\Http\Controllers\BookingController::class);
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    Route::get('ipaddresses/export', [App\Http\Controllers\IpAddressController::class, 'export'])->name('ipaddresses.export');
    Route::get('ipaddresses/generate', [App\Http\Controllers\IpAddressController::class, 'generateUnusedIPAddress'])->name('ipaddresses.generate');
    Route::resource('ipaddresses', App\Http\Controllers\IpAddressController::class)->except('show');
    Route::put('issues/assign-engineer/{id}', [App\Http\Controllers\IssueController::class, 'AssignEngineer'])->name('issues.assign');
    Route::resource('analytics', App\Http\Controllers\AnalysisController::class);
});
