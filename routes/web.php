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

Route::get('/test', function () {
    return view('customer_views.find-store');
});

Auth::routes();

Route::get('/home', 'Views\HomeController')->middleware('role:customer');
Route::get('/admin/dashboard/add_store', 'Views\AdminDashboardController@addStore')->middleware('role:admin');
Route::get('/admin/dashboard/add_manager', 'Views\AdminDashboardController@addManager')->middleware('role:admin');
Route::post('/admin/dashboard/add_manager', ['as' => 'manager.create', 'uses' => 'User\ManagerRegisterController@create']);
Route::get('/manager/dashboard', 'Views\ManagerDashboardController')->middleware('role:manager');

Route::get('/user_profile/edit', ['as' => 'user_profile.edit', 'uses' => 'User\UserController@edit']);
Route::patch('/user_profile/update', ['as' => 'user_profile.update', 'uses' => 'User\UserController@update']);
Route::patch('/user_profile/update/pass', ['as' => 'user_profile.updatePass', 'uses' => 'User\UserController@updatePass']);



// StoreController CRUD routes
Route::get('/stores', ['as' => 'stores.search', 'uses' => 'Store\StoreController@index']);
Route::get('/stores/create', 'Store\StoreController@create');
Route::post('/stores', ['as' => 'stores.store', 'uses' => 'Store\StoreController@store']);
Route::get('/stores/{store_id}', 'Store\StoreController@show');
Route::get('/stores/{store_id}/edit', 'Store\StoreController@edit');
Route::patch('/stores/{store_id}', ['as' => 'stores.update', 'uses' => 'Store\StoreController@update']);
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
Route::get('/appointments/{appointment_id}', 'Appointment\AppointmentController@show');
Route::get('/appointments/{appointment_id}/edit', 'Appointment\AppointmentController@edit');
Route::patch('/appointments/{appointment_id}', 'Appointment\AppointmentController@update');
Route::delete('/appointments/{appointment_id}', 'Appointment\AppointmentController@destroy');

Route::get('/queue', 'Appointment\QueueController@index');


