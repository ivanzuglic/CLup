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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users_edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::patch('/users_edit/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
