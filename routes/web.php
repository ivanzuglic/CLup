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

Route::get('/test', function () {
    return view('_login');
});

Auth::routes();

Route::get('/home', 'Views\HomeController@index')->middleware('role:2');
Route::get('/admin/dashboard', 'Views\AdminDashboardController@index')->middleware('role:1');
Route::get('/manager/dashboard', 'Views\ManagerDashboardController@index')->middleware('role:3');

Route::get('/user_profile/edit', ['as' => 'user_profile.edit', 'uses' => 'User\UserController@edit']);
Route::patch('/user_profile/update', ['as' => 'user_profile.update', 'uses' => 'User\UserController@update']);
