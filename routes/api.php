<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/stores', 'Store\StoreController@index');
Route::post('/stores', 'Store\StoreController@store');
Route::get('/stores/{store_id}', 'Store\StoreController@show');
Route::patch('/stores/{store_id}', 'Store\StoreController@update');
Route::delete('/stores/{store_id}', 'Store\StoreController@destroy');

Route::get('stores/{store_id}/working_hours', 'Store\WorkingHoursController@index');
Route::post('/stores/{store_id}/working_hours', 'Store\WorkingHoursController@store');
Route::get('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@show');
Route::patch('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@update');
Route::delete('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@destroy');


Route::get('/appointments', 'Appointment\AppointmentController@index');
Route::post('/appointments', 'Appointment\QueueController@insertUserAppointment');
Route::get('/appointments/{appointment_id}', 'Appointment\AppointmentController@show');
Route::patch('/appointments/{appointment_id}', 'Appointment\AppointmentController@update');
Route::delete('/appointments/{appointment_id}', 'Appointment\AppointmentController@destroy');

