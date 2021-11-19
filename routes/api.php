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
