<?php

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Customer-accessible pages
Route::get('/home', 'Views\HomeController')->middleware('role:customer');
Route::get('/home/search', ['as' => 'home.search', 'uses' => 'Store\StoreController@index'])->middleware('role:customer');
Route::get('/store/{store_id}/details', ['as' => 'store.show_details', 'uses' => 'Store\StoreController@show_details'])->middleware('role:customer');
Route::get('/user/{user_id}/placements', [ 'as' => 'placements', 'uses' => 'Appointment\AppointmentController@getActiveAppointmentsForUser'])->middleware('role:customer');
Route::get('/stores/country', ['as' => 'getCities', 'uses' => 'Store\StoreController@getCities'])->middleware('role:customer');

// Admin-accessible pages
Route::get('/admin/dashboard/add_store', 'Views\AdminDashboardController@addStore')->middleware('role:admin');
Route::post('/admin/dashboard/add_store', ['as' => 'add.store', 'uses' => 'Store\StoreController@store'])->middleware('role:admin');
Route::get('/admin/dashboard/add_manager', 'Views\AdminDashboardController@addManager')->middleware('role:admin');
Route::post('/admin/dashboard/add_manager', ['as' => 'add.manager', 'uses' => 'User\ManagerRegisterController@create'])->middleware('role:admin');

// Manager-accessible pages
Route::get('/manager/dashboard/store_parameters/{store_id}', 'Views\ManagerDashboardController@storeParameters')->middleware('role:manager');
Route::patch('/manager/dashboard/store_parameters/{store_id}/parameters/update', ['as' => 'parameters.update', 'uses' => 'Store\StoreController@update'])->middleware('role:manager');
Route::post('/manager/dashboard/store_parameters/{store_id}/working_hours/update', ['as' => 'working_hours.update', 'uses' => 'Store\WorkingHoursController@bulk_CUD'])->middleware('role:manager');
Route::get('/manager/dashboard/print_tickets/{store_id}', 'Views\ManagerDashboardController@printTickets')->middleware('role:manager');
Route::get('/manager/dashboard/store_statistics/{store_id}', 'Views\ManagerDashboardController@storeStatistics')->middleware('role:manager');

// Profile page accessible to all users
Route::get('/profile/edit', ['as' => 'profile.edit', 'uses' => 'User\UserController@edit'])->middleware('role:admin|customer|manager');
Route::patch('/profile/update', ['as' => 'profile.update', 'uses' => 'User\UserController@update'])->middleware('role:admin|customer|manager');
Route::patch('/profile/update/password', ['as' => 'profile.updatePassword', 'uses' => 'User\UserController@updatePassword'])->middleware('role:admin|customer|manager');

// Appointment-related routes accessible to Customers and/or managers
Route::get('/appointments/{appointment_id}/details', ['as' => 'appointment.show', 'uses' => 'Appointment\AppointmentController@show'])->middleware('role:customer');
Route::get('/appointments/{appointment_id}/pdf', ['as' => 'appointment.pdf' , 'uses' => 'Appointment\AppointmentController@print_ticket'])->middleware('role:customer|manager');
//      Adding a reservation
Route::post('/appointments/reservations', ['as' => 'appointment.addReservation', 'uses' => 'Appointment\QueueController@addReservation'])->middleware('role:customer');
//      Removing a reservation
Route::patch('/appointments/reservations/{appointment_id}', ['as' => 'appointment.removeReservation', 'uses' => 'Appointment\QueueController@removeReservation'])->middleware('role:customer');
//      Adding a queue entry
Route::post('/appointments/queue', ['as' => 'appointment.addQueue', 'uses' => 'Appointment\QueueController@addUserToQueue'])->middleware('role:customer');
//      Removing a queue entry
Route::patch('/appointments/queue/{appointment_id}', ['as' => 'appointment.removeQueue', 'uses' => 'Appointment\QueueController@removeUserFromQueue'])->middleware('role:customer');
//      Pushing back a queue entry
Route::post('/appointments/queue/{appointment_id}/push_back', ['as' => 'appointment.pushBackQueue', 'uses' => 'Appointment\QueueController@moveBackInQueue'])->middleware('role:customer');
//      Checking for an earlier timeslot
Route::get('/appointments/queue/{appointment_id}/available_earlier_timeslot', ['as' => 'appointment.earlierTimeslot', 'uses' => 'Appointment\QueueController@findEarlierTimeSlot'])->middleware('role:customer');
//      Pushing forward a queue entry
Route::patch('/appointments/queue/{appointment_id}/push_forward', ['as' => 'appointment.pushForwardQueue', 'uses' => 'Appointment\QueueController@moveUserEarlierInQueue'])->middleware('role:customer');
//      Adding a proxy queue entry
Route::post('/appointments/queue/proxy', ['as' => 'appointment.addQueueProxy', 'uses' => 'Appointment\QueueController@addProxyToQueue'])->middleware('role:manager');

// QR-code-related routes
Route::get('/scan/{appointment_id}', 'Appointment\AppointmentController@scan')->middleware('role:manager');


// ====== CRUD ======


// StoreController CRUD routes
Route::get('/stores', 'Store\StoreController@index')->middleware('role:admin');
Route::get('/stores/create', 'Store\StoreController@create')->middleware('role:admin');
Route::post('/stores', 'Store\StoreController@store')->middleware('role:admin');
Route::get('/stores/{store_id}', 'Store\StoreController@show')->middleware('role:admin');
Route::get('/stores/{store_id}/edit', 'Store\StoreController@edit')->middleware('role:admin');
Route::patch('/stores/{store_id}', 'Store\StoreController@update')->middleware('role:admin');
Route::delete('/stores/{store_id}', 'Store\StoreController@destroy')->middleware('role:admin');

// WorkingHoursController CRUD routes
Route::get('stores/{store_id}/working_hours', 'Store\WorkingHoursController@index')->middleware('role:admin');
Route::get('stores/{store_id}/working_hours/create', 'Store\WorkingHoursController@create')->middleware('role:admin');
Route::post('/stores/{store_id}/working_hours', 'Store\WorkingHoursController@store')->middleware('role:admin');
Route::get('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@show')->middleware('role:admin');
Route::get('/stores/{store_id}/working_hours/{working_hours_id}/edit', 'Store\WorkingHoursController@edit')->middleware('role:admin');
Route::patch('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@update')->middleware('role:admin');
Route::delete('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@destroy')->middleware('role:admin');

// AppointmentController and QueueController CRUD routes
Route::get('/appointments', 'Appointment\AppointmentController@index')->middleware('role:admin');
Route::get('/appointments/create', 'Appointment\AppointmentController@create')->middleware('role:admin');
Route::post('/appointments', 'Appointment\QueueController@insertUserAppointment')->middleware('role:admin');
Route::get('/appointments/{appointment_id}', 'Appointment\AppointmentController@show')->middleware('role:admin');
Route::get('/appointments/{appointment_id}/edit', 'Appointment\AppointmentController@edit')->middleware('role:admin');
Route::patch('/appointments/{appointment_id}', 'Appointment\AppointmentController@update')->middleware('role:admin');
Route::delete('/appointments/{appointment_id}', 'Appointment\AppointmentController@destroy')->middleware('role:admin');

// TEST routes
Route::post('/store/timeline', ['as' => 'store.timeline', 'uses' => 'Store\StoreController@generateTimelineArray'])->middleware('role:customer');
