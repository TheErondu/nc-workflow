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
    Route::get('v1/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::get('v1//', function () {
    //     return view('home');
    // });
        Route::resource('v1/messages', 'App\Http\Controllers\API\MessageController');
        Route::get('v1/messages/{id}/download', 'App\Http\Controllers\API\MessageController@download');
        Route::resource('v1/content', 'App\Http\Controllers\API\ContentController');
        Route::resource('v1/documents', 'App\Http\Controllers\API\DocumentController');
        Route::resource('v1/dutylog', 'App\Http\Controllers\API\DutyloggerController');
        Route::resource('v1/reports', 'App\Http\Controllers\API\ReportsController');
        Route::resource('v1/oblogs', 'App\Http\Controllers\API\OBlogsController');
        Route::resource('v1/schedule', 'App\Http\Controllers\API\ScheduleController');
        Route::resource('v1/roles', 'App\Http\Controllers\API\RoleController');
        Route::get('v1/calendar-event', [App\Http\Controllers\API\ScheduleController::class, 'index']);
        Route::post('v1/calendar-crud-ajax', [App\Http\Controllers\API\ScheduleController::class, 'calendarEvents']);
        Route::resource('v1/documents', 'App\Http\Controllers\API\DocumentController');
        Route::resource('v1/awards', 'App\Http\Controllers\API\AwardsController');
        Route::get('v1/show-of-the-week/new', 'App\Http\Controllers\API\AwardsController@CreateShow');
        Route::get('v1/awardee/new', 'App\Http\Controllers\API\AwardsController@CreateAward');
        Route::get('v1/team-of-month/new', 'App\Http\Controllers\API\AwardsController@CreateTeam');
        Route::resource('v1/vehicles', 'App\Http\Controllers\API\VehicleController');
        Route::get('v1/vehicles/delete/{id}', [App\Http\Controllers\API\VehicleController::class, 'delete']);
        Route::resource('v1/tracker', 'App\Http\Controllers\API\TrackerController');
        Route::get('v1/mileage/track/{id}', [App\Http\Controllers\API\TrackerController::class, 'track']);
        Route::resource('v1/triplogger', 'App\Http\Controllers\API\TripLoggerController');
        Route::resource('v1/departments', 'App\Http\Controllers\API\DepartmentController');

        Route::resource('v1/store', 'App\Http\Controllers\API\StoreController');
        Route::resource('v1/logs/mcr', 'App\Http\Controllers\API\McrLogsController');
        Route::resource('v1/logs/production', 'App\Http\Controllers\API\ProductionShowLogsController');
        Route::resource('v1/logs/engineers', 'App\Http\Controllers\API\EngineerLogsController');
        Route::resource('v1/logs/editors', 'App\Http\Controllers\API\EditorLogsController');
        Route::resource('v1/logs/prompter', 'App\Http\Controllers\API\PrompterLogsController');
        Route::resource('v1/logs/transmission', 'App\Http\Controllers\API\TransmissionReportController');
        Route::resource('v1/logs/cot', 'App\Http\Controllers\API\COTController');

        Route::get('v1/store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex');
        Route::get('v1/store-requests/create/{id}', 'App\Http\Controllers\API\StoreController@createRequest');
        Route::get('v1/store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex');
        Route::post('v1/store-requests/{id}', 'App\Http\Controllers\API\StoreController@storeRequest');
        Route::get('v1/store-requests/{id}', 'App\Http\Controllers\API\StoreController@editRequest');
        Route::put('v1/store-requests/approve/{id}', 'App\Http\Controllers\API\StoreController@Approve');
        Route::put('v1/store-requests/reject/{id}', 'App\Http\Controllers\API\StoreController@Reject');
        Route::put('v1/store-requests/return/{id}', 'App\Http\Controllers\API\StoreController@Return');
        Route::resource('v1/employees', 'App\Http\Controllers\API\EmployeeController');
        Route::resource('v1/issues', 'App\Http\Controllers\API\IssueController');
        Route::get('v1/animation', 'App\Http\Controllers\API\LottieController@index');
        Route::resource('v1/facility', App\Http\Controllers\API\FacilityController::class);
        Route::resource('v1/cots', App\Http\Controllers\API\COTController::class);
        Route::resource('v1/facility_type', App\Http\Controllers\API\FacilityTypeController::class);
        Route::resource('v1/booking', App\Http\Controllers\API\BookingController::class);
        Route::resource('v1/employees', App\Http\Controllers\API\EmployeeController::class);
        Route::put('v1/employees/password/reset/{id}', [App\Http\Controllers\API\EmployeeController::class, 'resetpass']);
        Route::resource('v1/analytics', App\Http\Controllers\API\AnalysisController::class);


});




