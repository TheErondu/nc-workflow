<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::get('schedule/preproduction', [App\Http\Controllers\API\ScheduleController::class, 'index']);
Route::get('schedule/video', [App\Http\Controllers\API\ScheduleController::class, 'GetVideoEditorsEvents']);
Route::get('schedule/graphics', [App\Http\Controllers\API\ScheduleController::class, 'GetGraphicEditorsEvents']);
Route::get('schedule/digital', [App\Http\Controllers\API\ScheduleController::class, 'GetDigitalEvents']);
Route::post('calendar-crud-ajax', [App\Http\Controllers\API\ScheduleController::class, 'calendarEvents']);
Route::get('content', [App\Http\Controllers\API\ContentController::class, 'index']);
Route::get('sales-production', [App\Http\Controllers\API\SalesScheduleController::class, 'index']);
Route::get('booking', [App\Http\Controllers\API\BookingController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/', function () {
    //     return view('home');
    // });
        Route::resource('messages', 'App\Http\Controllers\API\MessageController');
        Route::get('messages/{id}/download', 'App\Http\Controllers\API\MessageController@download')->name('file.download');
        Route::resource('content', 'App\Http\Controllers\API\ContentController');
        Route::resource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::resource('dutylog', 'App\Http\Controllers\API\DutyloggerController');
        Route::resource('reports', 'App\Http\Controllers\API\ReportsController');
        Route::resource('oblogs', 'App\Http\Controllers\API\OBlogsController');
        Route::resource('schedule', 'App\Http\Controllers\API\ScheduleController');
        Route::resource('roles', 'App\Http\Controllers\API\RoleController');
        Route::get('calendar-event', [App\Http\Controllers\API\ScheduleController::class, 'index']);
        Route::post('calendar-crud-ajax', [App\Http\Controllers\API\ScheduleController::class, 'calendarEvents']);
        Route::resource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::resource('awards', 'App\Http\Controllers\API\AwardsController');
        Route::get('show-of-the-week/new', 'App\Http\Controllers\API\AwardsController@CreateShow');
        Route::get('awardee/new', 'App\Http\Controllers\API\AwardsController@CreateAward');
        Route::get('team-of-month/new', 'App\Http\Controllers\API\AwardsController@CreateTeam');
        Route::resource('vehicles', 'App\Http\Controllers\API\VehicleController');
        Route::get('vehicles/delete/{id}', [App\Http\Controllers\API\VehicleController::class, 'delete'])->name('delete');
        Route::resource('tracker', 'App\Http\Controllers\API\TrackerController');
        Route::get('mileage/track/{id}', [App\Http\Controllers\API\TrackerController::class, 'track'])->name('tracker.track');
        Route::resource('triplogger', 'App\Http\Controllers\API\TripLoggerController');
        Route::resource('departments', 'App\Http\Controllers\API\DepartmentController');

        Route::resource('store', 'App\Http\Controllers\API\StoreController');
        Route::resource('logs/mcr', 'App\Http\Controllers\API\McrLogsController');
        Route::resource('logs/production', 'App\Http\Controllers\API\ProductionShowLogsController');
        Route::resource('logs/engineers', 'App\Http\Controllers\API\EngineerLogsController');
        Route::resource('logs/editors', 'App\Http\Controllers\API\EditorLogsController');
        Route::resource('logs/prompter', 'App\Http\Controllers\API\PrompterLogsController');
        Route::resource('logs/transmission', 'App\Http\Controllers\API\TransmissionReportController');
        Route::resource('logs/cot', 'App\Http\Controllers\API\COTController');

        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::get('store-requests/create/{id}', 'App\Http\Controllers\API\StoreController@createRequest')->name('store-requests.create');
        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::post('store-requests/{id}', 'App\Http\Controllers\API\StoreController@storeRequest')->name('store-requests.store');
        Route::get('store-requests/{id}', 'App\Http\Controllers\API\StoreController@editRequest')->name('store-requests.edit');
        Route::put('store-requests/approve/{id}', 'App\Http\Controllers\API\StoreController@Approve')->name('store-requests.approve');
        Route::put('store-requests/reject/{id}', 'App\Http\Controllers\API\StoreController@Reject')->name('store-requests.reject');
        Route::put('store-requests/return/{id}', 'App\Http\Controllers\API\StoreController@Return')->name('store-requests.return');
        Route::resource('employees', 'App\Http\Controllers\API\EmployeeController');
        Route::resource('issues', 'App\Http\Controllers\API\IssueController');
        Route::get('animation', 'App\Http\Controllers\API\LottieController@index');
        Route::resource('facility', App\Http\Controllers\API\FacilityController::class);
        Route::resource('cots', App\Http\Controllers\API\COTController::class);
        Route::resource('facility_type', App\Http\Controllers\API\FacilityTypeController::class);
        Route::resource('booking', App\Http\Controllers\API\BookingController::class);
        Route::resource('employees', App\Http\Controllers\API\EmployeeController::class);
        Route::put('employees/password/reset/{id}', [App\Http\Controllers\API\EmployeeController::class, 'resetpass'])->name('employees.reset');
        Route::resource('analytics', App\Http\Controllers\API\AnalysisController::class);


});




