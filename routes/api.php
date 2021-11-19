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
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::get('/', function () {
    //     return view('home');
    // });
        Route::apiResource('v1/messages', 'App\Http\Controllers\API\MessageController');
        Route::apiResource('v1/content', 'App\Http\Controllers\API\ContentController');
        Route::apiResource('v1/documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('v1/dutylog', 'App\Http\Controllers\API\DutyloggerController');
        Route::apiResource('v1/reports', 'App\Http\Controllers\API\ReportsController');
        Route::apiResource('v1/oblogs', 'App\Http\Controllers\API\OBlogsController');
        Route::apiResource('v1/schedule', 'App\Http\Controllers\API\ScheduleController');
        Route::apiResource('v1/roles', 'App\Http\Controllers\API\RoleController');
        Route::apiResource('v1/documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('v1/awards', 'App\Http\Controllers\API\AwardsController');
        Route::apiResource('v1/vehicles', 'App\Http\Controllers\API\VehicleController');
        Route::apiResource('v1/tracker', 'App\Http\Controllers\API\TrackerController');
        Route::apiResource('v1/triplogger', 'App\Http\Controllers\API\TripLoggerController');
        Route::apiResource('v1/departments', 'App\Http\Controllers\API\DepartmentController');

        Route::apiResource('v1/store', 'App\Http\Controllers\API\StoreController');
        Route::apiResource('v1/logs/mcr', 'App\Http\Controllers\API\McrLogsController');
        Route::apiResource('v1/logs/production', 'App\Http\Controllers\API\ProductionShowLogsController');
        Route::apiResource('v1/logs/engineers', 'App\Http\Controllers\API\EngineerLogsController');
        Route::apiResource('v1/logs/editors', 'App\Http\Controllers\API\EditorLogsController');
        Route::apiResource('v1/logs/prompter', 'App\Http\Controllers\API\PrompterLogsController');
        Route::apiResource('v1/logs/transmission', 'App\Http\Controllers\API\TransmissionReportController');
        Route::apiResource('v1/logs/cot', 'App\Http\Controllers\API\COTController');
        Route::apiResource('v1/employees', 'App\Http\Controllers\API\EmployeeController');
        Route::apiResource('v1/issues', 'App\Http\Controllers\API\IssueController');
        Route::apiResource('v1/facility', App\Http\Controllers\API\FacilityController::class);
        Route::apiResource('v1/cots', App\Http\Controllers\API\COTController::class);
        Route::apiResource('v1/facility_type', App\Http\Controllers\API\FacilityTypeController::class);
        Route::apiResource('v1/booking', App\Http\Controllers\API\BookingController::class);
        Route::apiResource('v1/employees', App\Http\Controllers\API\EmployeeController::class);
        Route::apiResource('v1/analytics', App\Http\Controllers\API\AnalysisController::class);


});




