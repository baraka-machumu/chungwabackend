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

use App\Notifications\SmsNotification;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user','UserController');
Route::post('user/login','UserController@store');
Route::post('user/register', 'UserController@registerUser');
Route::post('send/email', 'UserController@registerUser');



Route::post('user/login','UserController@loginuser');

Route::get('send',function (){

    $user = new User();
    $user->phone_number= '+255754997494';   // Don't forget specify country code.
    $user->notify(new SMSNotification());

});




