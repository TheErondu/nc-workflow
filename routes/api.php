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
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('api');
    // Route::get('/', function () {
    //     return view('home');
    // });
        Route::apiResource('messages', 'App\Http\Controllers\API\MessageController');
        Route::get('messages/{id}/download', 'App\Http\Controllers\API\MessageController@download')->name('file.download');
        Route::apiResource('content', 'App\Http\Controllers\API\ContentController');
        Route::apiResource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('dutylog', 'App\Http\Controllers\API\DutyloggerController');
        Route::apiResource('reports', 'App\Http\Controllers\API\ReportsController');
        Route::apiResource('oblogs', 'App\Http\Controllers\API\OBlogsController');
        Route::apiResource('schedule', 'App\Http\Controllers\API\ScheduleController');
        Route::apiResource('roles', 'App\Http\Controllers\API\RoleController');
        Route::get('calendar-event', [App\Http\Controllers\API\ScheduleController::class, 'index']);
        Route::post('calendar-crud-ajax', [App\Http\Controllers\API\ScheduleController::class, 'calendarEvents']);
        Route::apiResource('documents', 'App\Http\Controllers\API\DocumentController');
        Route::apiResource('awards', 'App\Http\Controllers\API\AwardsController');
        Route::get('show-of-the-week/new', 'App\Http\Controllers\API\AwardsController@CreateShow');
        Route::get('awardee/new', 'App\Http\Controllers\API\AwardsController@CreateAward');
        Route::get('team-of-month/new', 'App\Http\Controllers\API\AwardsController@CreateTeam');
        Route::apiResource('vehicles', 'App\Http\Controllers\API\VehicleController');
        Route::get('vehicles/delete/{id}', [App\Http\Controllers\API\VehicleController::class, 'delete'])->name('delete');
        Route::apiResource('tracker', 'App\Http\Controllers\API\TrackerController');
        Route::get('mileage/track/{id}', [App\Http\Controllers\API\TrackerController::class, 'track'])->name('tracker.track');
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

        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::get('store-requests/create/{id}', 'App\Http\Controllers\API\StoreController@createRequest')->name('store-requests.create');
        Route::get('store-requests', 'App\Http\Controllers\API\StoreController@RequestIndex')->name('store-requests.index');
        Route::post('store-requests/{id}', 'App\Http\Controllers\API\StoreController@storeRequest')->name('store-requests.store');
        Route::get('store-requests/{id}', 'App\Http\Controllers\API\StoreController@editRequest')->name('store-requests.edit');
        Route::put('store-requests/approve/{id}', 'App\Http\Controllers\API\StoreController@Approve')->name('store-requests.approve');
        Route::put('store-requests/reject/{id}', 'App\Http\Controllers\API\StoreController@Reject')->name('store-requests.reject');
        Route::put('store-requests/return/{id}', 'App\Http\Controllers\API\StoreController@Return')->name('store-requests.return');
        Route::apiResource('employees', 'App\Http\Controllers\API\EmployeeController');
        Route::apiResource('issues', 'App\Http\Controllers\API\IssueController');
        Route::get('animation', 'App\Http\Controllers\API\LottieController@index');
        Route::apiResource('facility', App\Http\Controllers\API\FacilityController::class);
        Route::apiResource('cots', App\Http\Controllers\API\COTController::class);
        Route::apiResource('facility_type', App\Http\Controllers\API\FacilityTypeController::class);
        Route::apiResource('booking', App\Http\Controllers\API\BookingController::class);
        Route::apiResource('employees', App\Http\Controllers\API\EmployeeController::class);
        Route::put('employees/password/reset/{id}', [App\Http\Controllers\API\EmployeeController::class, 'resetpass'])->name('employees.reset');
        Route::apiResource('analytics', App\Http\Controllers\API\AnalysisController::class);


});




