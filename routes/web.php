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

// Customer-accessible Home page
Route::get('/home', 'Views\HomeController')->middleware('role:customer');
Route::get('/home/search', ['as' => 'home.search', 'uses' => 'Store\StoreController@index'])->middleware('role:customer');
Route::get('/store/{store_id}/details', ['as' => 'store.show_details', 'uses' => 'Store\StoreController@show_details'])->middleware('role:customer');
// Admin-accessible Dashboard pages
Route::get('/admin/dashboard/add_store', 'Views\AdminDashboardController@addStore')->middleware('role:admin');
Route::post('/admin/dashboard/add_store', ['as' => 'add.store', 'uses' => 'Store\StoreController@store'])->middleware('role:admin');
Route::get('/admin/dashboard/add_manager', 'Views\AdminDashboardController@addManager')->middleware('role:admin');
Route::post('/admin/dashboard/add_manager', ['as' => 'add.manager', 'uses' => 'User\ManagerRegisterController@create'])->middleware('role:admin');
// Manager-accessible Dashboard pages
Route::get('/manager/dashboard/store_parameters/{store_id}', 'Views\ManagerDashboardController@storeParameters')->middleware('role:manager');
Route::patch('/manager/dashboard/store_parameters/{store_id}/parameters/update', ['as' => 'parameters.update', 'uses' => 'Store\StoreController@update'])->middleware('role:manager');
Route::post('/manager/dashboard/store_parameters/{store_id}/working_hours/update', ['as' => 'working_hours.update', 'uses' => 'Store\WorkingHoursController@bulk_CUD'])->middleware('role:manager');
Route::get('/manager/dashboard/print_tickets/{store_id}', 'Views\ManagerDashboardController@printTickets')->middleware('role:manager');
// Profile page accessible to all users
Route::get('/profile/edit', ['as' => 'profile.edit', 'uses' => 'User\UserController@edit'])->middleware('role:admin|customer|manager');
Route::patch('/profile/update', ['as' => 'profile.update', 'uses' => 'User\UserController@update'])->middleware('role:admin|customer|manager');
Route::patch('/profile/update/password', ['as' => 'profile.updatePassword', 'uses' => 'User\UserController@updatePassword'])->middleware('role:admin|customer|manager');

// StoreController CRUD routes
Route::get('/stores', 'Store\StoreController@index');
Route::get('/stores/create', 'Store\StoreController@create');
Route::post('/stores', 'Store\StoreController@store');
Route::get('/stores/{store_id}', 'Store\StoreController@show');
Route::get('/stores/{store_id}/edit', 'Store\StoreController@edit');
Route::patch('/stores/{store_id}', 'Store\StoreController@update');
Route::delete('/stores/{store_id}', 'Store\StoreController@destroy');

// WorkingHoursController CRUD routes
Route::get('stores/{store_id}/working_hours', 'Store\WorkingHoursController@index');
Route::get('stores/{store_id}/working_hours/create', 'Store\WorkingHoursController@create');
Route::post('/stores/{store_id}/working_hours', 'Store\WorkingHoursController@store');
Route::get('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@show');
Route::get('/stores/{store_id}/working_hours/{working_hours_id}/edit', 'Store\WorkingHoursController@edit');
Route::patch('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@update');
Route::delete('/stores/{store_id}/working_hours/{working_hours_id}', 'Store\WorkingHoursController@destroy');

// AppointmentController and QueueController CRUD routes
Route::get('/appointments', 'Appointment\AppointmentController@index');
Route::get('/appointments/create', 'Appointment\AppointmentController@create');
Route::post('/appointments', 'Appointment\QueueController@insertUserAppointment');
Route::get('/appointments/{appointment_id}', ['as' => 'appointment.show', 'uses' => 'Appointment\AppointmentController@show']);
Route::get('/appointments/{appointment_id}/edit', 'Appointment\AppointmentController@edit');
Route::patch('/appointments/{appointment_id}', 'Appointment\AppointmentController@update');
Route::delete('/appointments/{appointment_id}', 'Appointment\AppointmentController@destroy');

//QR code routes
Route::get('/qr_response', 'Appointment\QueueController@QrResponse');
Route::get('/scan/{appointment_id}', 'Appointment\AppointmentController@scan');
Route::get('/appointments/{appointment_id}/pdf', ['as' => 'appointment.pdf' , 'uses' => 'Appointment\AppointmentController@print_ticket']);


Route::get('/queue', 'Appointment\QueueController@index');
Route::post('/addToQueue', ['as' => 'addToQueue', 'uses' => 'Appointment\QueueController@addUserToQueue']);
Route::post('/addProxyToQueue', ['as' => 'addProxyToQueue', 'uses' => 'Appointment\QueueController@addProxyToQueue']);
Route::patch('/removeFromQueue/{appointment_id}', ['as' => 'removeFromQueue', 'uses' => 'Appointment\QueueController@removeUserFromQueue']);


// Adding a reservation route
Route::post('/appointments/reservations', ['as' => 'appointment.addReservation', 'uses' => 'Appointment\QueueController@addReservation'])->middleware('role:customer');
// Removing a reservation route
Route::patch('/appointments/reservations/{appointment_id}', ['as' => 'appointment.removeReservation', 'uses' => 'Appointment\QueueController@removeReservation'])->middleware('role:customer');

// My Placements route
Route::get('/user/{user_id}/placements', [ 'as' => 'placements', 'uses' => 'Appointment\AppointmentController@getActiveAppointmentsForUser'])->middleware('role:customer');

