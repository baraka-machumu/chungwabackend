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

Route::resource('user','UserController');
Route::post('user/login','UserController@store');

Route::get('list',function(){

   $list =  [1,1,2,3,4,6,7,8];

    echo $list[$list[5]];
});