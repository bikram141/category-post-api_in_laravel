<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use validator;

class UserController extends Controller
{
    public function index(){
        $user =User::get();
        return response()->json(['success'=>true,
        'msg'=>"user list",
        'data'=>$user]);
    }

    public function store(Request $request){
        $validator=\Validator::make($request->all(), [
            "name" =>"required",
            "email" =>"required|unique:users|regex:/(.+)@(.+)\.(.+)/i",
            "password"=>"required"

   ]);
      if ($validator->fails())
       {
       return response()->json(['errors'=>$validator->errors()->all(),'status_code'=>500],500);
       }

       $user = new User();
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->password = Hash::make($request->input('password'));  
       $user->save();     
       if($user)
       {
           return response()->json([
            'message'=>'user added successfully',
            'status_code'=>200
        ],200);
       }
       else
       {
        return response()->json(['message'=>'Server Error Occurs.Please Try Again','status_code'=>500],500);
       }
    }
}
