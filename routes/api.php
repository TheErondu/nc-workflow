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

//API route for login user
Route::post('token', [App\Http\Controllers\API\AuthController::class, 'requestToken']);

Route::get('schedule/preproduction', [App\Http\Controllers\API\ScheduleController::class, 'index']);
Route::get('schedule/editors', [App\Http\Controllers\API\ScheduleController::class, 'GetVideoEditorsEvents']);
Route::get('schedule/graphics', [App\Http\Controllers\API\ScheduleController::class, 'GetGraphicEditorsEvents']);
Route::get('schedule/digital', [App\Http\Controllers\API\ScheduleController::class, 'GetDigitalEvents']);
Route::post('calendar-crud-ajax', [App\Http\Controllers\API\ScheduleController::class, 'calendarEvents']);
Route::get('content', [App\Http\Controllers\API\ContentController::class, 'index']);
Route::get('sales-production', [App\Http\Controllers\API\SalesScheduleController::class, 'index']);
Route::get('maintenance-schedule', [App\Http\Controllers\API\MaintenanceSchedulerController::class, 'index']);
Route::get('booking', [App\Http\Controllers\API\BookingController::class, 'index']);
Route::get('production-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'ProductionShowLogs']);
Route::get('reports-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'DirectorReports']);
Route::get('editors-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'EditorLogs']);
Route::get('oblogs-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'ObLogs']);
Route::get('mcrlogs-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'McrLogs']);
Route::get('graphics-news-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'GraphicsLogs']);
Route::get('graphics-shows-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'GraphicsLogShows']);
Route::get('prompter-news-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'PrompterLogs']);
Route::get('prompter-shows-calendar', [App\Http\Controllers\API\CalendarViewController::class, 'prompterlogShows']);


Route::group(['middleware' => ['auth:sanctum'],[]], function () {


    Route::name('api.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::get('/', function () {
    //     return view('home');
    // });
    Route::get('book', [App\Http\Controllers\API\BookController::class, 'index']);
        Route::apiResource('messages', 'App\Http\Controllers\API\MessageController');
        Route::apiResource('content', 'App\Http\Controllers\API\ContentController');
        Route::apiResource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('dutylog', 'App\Http\Controllers\API\DutyloggerController');
        Route::apiResource('oblogs', 'App\Http\Controllers\API\OBlogsController');
        Route::apiResource('schedule', 'App\Http\Controllers\API\ScheduleController');
        Route::apiResource('reports', 'App\Http\Controllers\API\ReportsController');
        Route::apiResource('roles', 'App\Http\Controllers\API\RoleController');
        Route::apiResource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('awards', 'App\Http\Controllers\API\AwardsController');
        Route::apiResource('vehicles', 'App\Http\Controllers\API\VehicleController');
        Route::apiResource('tracker', 'App\Http\Controllers\API\TrackerController');
        Route::apiResource('triplogger', 'App\Http\Controllers\API\TripLoggerController');
        Route::apiResource('departments', 'App\Http\Controllers\API\DepartmentController');

        Route::apiResource('store', 'App\Http\Controllers\API\StoreController');
        Route::apiResource('logs/mcr', 'App\Http\Controllers\API\McrLogsController');
        Route::apiResource('logs/production', 'App\Http\Controllers\API\ProductionShowLogsController');
        Route::apiResource('logs/engineers', 'App\Http\Controllers\API\EngineerLogsController');
        Route::apiResource('logs/editors', 'App\Http\Controllers\API\EditorLogsController');
        Route::apiResource('logs/prompter', 'App\Http\Controllers\API\PrompterLogsController');
        Route::apiResource('logs/transmission', 'App\Http\Controllers\API\TransmissionReportController');
        Route::apiResource('logs/cot', 'App\Http\Controllers\API\COTController');
        Route::apiResource('employees', 'App\Http\Controllers\API\EmployeeController');
        Route::apiResource('issues', 'App\Http\Controllers\API\IssueController');
        Route::apiResource('facility', App\Http\Controllers\API\FacilityController::class);
        Route::apiResource('cots', App\Http\Controllers\API\COTController::class);
        Route::apiResource('facility_type', App\Http\Controllers\API\FacilityTypeController::class);
        Route::apiResource('booking', App\Http\Controllers\API\BookingController::class);
        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::get('store-requests/create/{id}', 'App\Http\Controllers\API\StoreController@createRequest')->name('store-requests.create');
        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::post('store-requests/{id}', 'App\Http\Controllers\API\StoreController@storeRequest')->name('store-requests.store');
        Route::get('store-requests/{id}', 'App\Http\Controllers\API\StoreController@editRequest')->name('store-requests.edit');
        Route::put('store-requests/approve/{id}', 'App\Http\Controllers\API\StoreController@Approve')->name('store-requests.approve');
        Route::put('store-requests/reject/{id}', 'App\Http\Controllers\API\StoreController@Reject')->name('store-requests.reject');
        Route::put('store-requests/return/{id}', 'App\Http\Controllers\API\StoreController@Return')->name('store-requests.return');
        Route::apiResource('employees', App\Http\Controllers\API\EmployeeController::class);
        Route::apiResource('analytics', App\Http\Controllers\API\AnalysisController::class);
    });

});




