<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuth\JWTGuard;
use JWTAuthException;
use App\User;

class UserController extends Controller
{
       public function __construct()
    {
        $this->user = new User;
    }

    public function login(Request $request){

        $credentials = $request->only('username', 'password');



        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {

                return response()->json([
                    'response' => 'error',
                    'token' => 'Invalid Email or Password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'token' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
        
                'token' => $token,
            
        ]);
    }

        public function getAuthUser(Request $request){

        $user = JWTAuth::toUser($request->token);        
        return response()->json(['result'=>$user]);
    }




    public function logout(Request $request) 
    {
         $token = $request->get("token");

        $response =  JWTAuth::setToken($token)->invalidate();

        if ($response) {
            
            return response()->json(['response'=>'true']);
        }  else {

            return response()->json(['response'=>'false']);
        }

    }
}


