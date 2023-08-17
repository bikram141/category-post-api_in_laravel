<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use validator;


class CategoryController extends Controller
{
    public function index(){
        $category =Category::get();
        return response()->json(['success'=>true,
        'msg'=>"category list",
        'data'=>$category]);
    }

    public function store(Request $request){
        $validator=\Validator::make($request->all(), [
            "name" =>"required",
   ]);
      if ($validator->fails())
       {
       return response()->json(['errors'=>$validator->errors()->all(),'status_code'=>500],500);
       }

       $name=$request->name;
       $result=DB::table('categories')->insert(array('name'=>$name));
       if($result)
       {
           return response()->json([
            'message'=>'category added successfully',
            'status_code'=>200
        ],200);
       }
       else
       {
        return response()->json(['message'=>'Server Error Occurs.Please Try Again','status_code'=>500],500);
       }
    }
}
