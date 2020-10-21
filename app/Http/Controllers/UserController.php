<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
            'isAdmin' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $details = $request->all();
        $details['password'] = Hash::make($request->newPassword);
        $user = User::create($details);
        $token = $user->createToken($user->name)->accessToken;
        $response = [
            "user"=>$user,
            "token"=>$token
        ];
        return response()->json([$response]);
    }
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken($user->name)->accessToken; 
            $success['name'] = $user['name'];
            $success['id'] = $user['id'];
            return response()->json(['success' => $success] ); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    public function view(){
        $user = User::all();
        return response()->json($user);
    }
}
