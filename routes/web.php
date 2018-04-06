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

Route::get('/', ['uses' => 'UsersController@index']);
Route::resource('users', 'UsersController');
Route::resource('roles', 'RolesController');
Route::resource('dummy', 'DummyController');