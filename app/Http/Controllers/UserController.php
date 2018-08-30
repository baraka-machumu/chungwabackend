<?php

namespace App\Http\Controllers;

use App\Notifications\SmsNotification;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __construct()
    {
        $this->user = new User;
    }

    public function  loginuser(){

        $currentTime = round(microtime(true));

        $email =  $_POST['email'];
        $password  =$_POST['password'];
        $password =  Hash::make($password);

        $userdata = DB::table('users')->select('id','email','phone','username','password')->where('email', $email)->first();
        if ($userdata && Hash::check(Input::get('password'), $userdata->password)) {

            $key = "chungwa-app-2018-user-loigin".$email."p".$password;
            $token =  array(
                "id" => $userdata->id,
                "email"=>$userdata->email,
                "phone"=>$userdata->phone,
                "username"=>$userdata->username,
                "seed" => rand(1, 100),
            );
            $jwttoken = JWT::encode($token, $key);
            $decodedPayloadData = JWT::decode($jwttoken, $key, array('HS256'));

            return response()->json([$decodedPayloadData])->header('Content-Type', 'application/plain');


        } else {

        }



    }
    public function registerUser(Request $request)
    {
        $user = new User();
        $email = $request->get('email');
        $user->email=$email;

        $code = $request->get('code');
        $success =  $user->save();

        if ($success){

            $this->sendMailExcution($code);

            return response()->json(['success'=>true,'massage'=>'Successful Registered'])->header('Content-Type', 'application/json');
        } else {
            return response()->json(['success'=>false,'message'=>'Failed To register'])->header('Content-Type', 'application/json');;

        }

    }
    public function sendMailExcution($code){

        $user = new User();
        $user->email= 'barakabryson@gmail.com';

        $user->notify(new SMSNotification($code));

    }



}


