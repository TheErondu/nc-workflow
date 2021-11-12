<?php

use App\Events\UserLoggedIn;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dumplogs', 'App\Http\Controllers\COTController@DumpLogs');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });
        Route::resource('messages', 'App\Http\Controllers\MessageController');
        Route::get('messages/{id}/download', 'App\Http\Controllers\MessageController@download')->name('file.download');
        Route::resource('content', 'App\Http\Controllers\ContentController');
        Route::resource('sales-production', 'App\Http\Controllers\SalesScheduleController');
        Route::resource('documents', 'App\Http\Controllers\DocumentController');
        Route::resource('dutylog', 'App\Http\Controllers\DutyloggerController');
        Route::resource('reports', 'App\Http\Controllers\ReportsController');
        Route::resource('oblogs', 'App\Http\Controllers\OBlogsController');
        Route::resource('schedule', 'App\Http\Controllers\ScheduleController');
        Route::resource('roles', 'App\Http\Controllers\RoleController');
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

        Route::resource('store', 'App\Http\Controllers\StoreController');
        Route::resource('logs/mcr', 'App\Http\Controllers\McrLogsController');
        Route::resource('logs/production', 'App\Http\Controllers\ProductionShowLogsController');
        Route::resource('logs/engineers', 'App\Http\Controllers\EngineerLogsController');
        Route::resource('logs/editors', 'App\Http\Controllers\EditorLogsController');
        Route::resource('logs/prompter', 'App\Http\Controllers\PrompterLogsController');
        Route::resource('logs/transmission', 'App\Http\Controllers\TransmissionReportController');
        Route::resource('logs/cot', 'App\Http\Controllers\COTController');

        Route::get('store-requests', 'App\Http\Controllers\StoreController@RequestIndex')->name('store-requests.index');
        Route::get('store-requests/create/{id}', 'App\Http\Controllers\StoreController@createRequest')->name('store-requests.create');
        Route::get('store-requests', 'App\Http\Controllers\StoreController@RequestIndex')->name('store-requests.index');
        Route::post('store-requests/{id}', 'App\Http\Controllers\StoreController@storeRequest')->name('store-requests.store');
        Route::get('store-requests/{id}', 'App\Http\Controllers\StoreController@editRequest')->name('store-requests.edit');
        Route::put('store-requests/approve/{id}', 'App\Http\Controllers\StoreController@Approve')->name('store-requests.approve');
        Route::put('store-requests/reject/{id}', 'App\Http\Controllers\StoreController@Reject')->name('store-requests.reject');
        Route::put('store-requests/return/{id}', 'App\Http\Controllers\StoreController@Return')->name('store-requests.return');
        Route::resource('employees', 'App\Http\Controllers\EmployeeController');
        Route::resource('issues', 'App\Http\Controllers\IssueController');
        Route::get('animation', 'App\Http\Controllers\LottieController@index');
        Route::resource('facility', App\Http\Controllers\FacilityController::class);
        Route::resource('cots', App\Http\Controllers\COTController::class);
        Route::resource('facility_type', App\Http\Controllers\FacilityTypeController::class);
        Route::resource('booking', App\Http\Controllers\BookingController::class);
        Route::resource('employees', App\Http\Controllers\EmployeeController::class);
        Route::put('employees/password/reset/{id}', [App\Http\Controllers\EmployeeController::class, 'resetpass'])->name('employees.reset');
        Route::resource('analytics', App\Http\Controllers\AnalysisController::class);

        Route::get('/event-test', function() {
            event( new UserLoggedIn('erone007@gmail.com') );

            return '<h1>Funy Page</h1>';
        });



});



