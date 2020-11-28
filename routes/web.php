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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'Views\HomeController')->middleware('role:customer');
Route::get('/admin/dashboard', 'Views\AdminDashboardController')->middleware('role:admin');
Route::get('/manager/dashboard', 'Views\ManagerDashboardController')->middleware('role:manager');

Route::get('/user_profile/edit', ['as' => 'user_profile.edit', 'uses' => 'User\UserController@edit']);
Route::patch('/user_profile/update', ['as' => 'user_profile.update', 'uses' => 'User\UserController@update']);

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
