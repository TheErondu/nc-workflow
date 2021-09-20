<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });
        Route::resource('messages', 'App\Http\Controllers\MessageController');
        Route::get('messages/{id}/download', 'App\Http\Controllers\MessageController@download')->name('file.download');
        Route::resource('content', 'App\Http\Controllers\ContentController');
        Route::resource('documents', 'App\Http\Controllers\DocumentController');
        Route::resource('dutylog', 'App\Http\Controllers\DutyloggerController');
        Route::resource('reports', 'App\Http\Controllers\ReportsController');
        Route::resource('oblogs', 'App\Http\Controllers\OBlogsController');
        Route::resource('schedule', 'App\Http\Controllers\ScheduleController');
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
        Route::get('store-requests', 'App\Http\Controllers\StoreController@RequestIndex')->name('store-requests.index');
        Route::get('store-requests/create/{id}', 'App\Http\Controllers\StoreController@createRequest')->name('store-requests.create');
        Route::get('store-requests', 'App\Http\Controllers\StoreController@RequestIndex')->name('store-requests.index');
        Route::post('store-requests/{id}', 'App\Http\Controllers\StoreController@storeRequest')->name('store-requests.store');
        Route::get('store-requests/{id}', 'App\Http\Controllers\StoreController@editRequest')->name('store-requests.edit');
        Route::put('store-requests/approve/{id}', 'App\Http\Controllers\StoreController@Approve')->name('store-requests.approve');
        Route::put('store-requests/reject/{id}', 'App\Http\Controllers\StoreController@Reject')->name('store-requests.reject');
        Route::put('store-requests/return/{id}', 'App\Http\Controllers\StoreController@Return')->name('store-requests.return');
        Route::resource('employees', 'App\Http\Controllers\EmployeeController');
        Route::get('animation', 'App\Http\Controllers\LottieController@index');
        

});



