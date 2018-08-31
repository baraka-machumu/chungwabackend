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


Route::resource('user','UserController');
Route::post('user/login','UserController@loguser');
Route::post('user/register', 'UserController@registerUser');
Route::post('send/email', 'UserController@registerUser');





