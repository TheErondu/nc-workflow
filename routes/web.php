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
        Route::resource('schedule', 'App\Http\Controllers\ScheduleController');
        Route::get('calendar-event', [App\Http\Controllers\ScheduleController::class, 'index']);
Route::post('calendar-crud-ajax', [App\Http\Controllers\ScheduleController::class, 'calendarEvents']);
        Route::resource('documents', 'App\Http\Controllers\DocumentController');
        Route::resource('humans', 'App\Http\Controllers\HumansController');
        Route::resource('tracker', 'App\Http\Controllers\VehicleController');
        Route::resource('vehicles', 'App\Http\Controllers\TrackerController');
        Route::resource('departments', 'App\Http\Controllers\DepartmentController');
        Route::resource('store', 'App\Http\Controllers\StoreController');
        Route::resource('employees', 'App\Http\Controllers\EmployeeController');
});
