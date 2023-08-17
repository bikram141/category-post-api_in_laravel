<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $post =Post::paginate(5);
        return response()->json(['success'=>true,
        'msg'=>"post list",
        'data'=>$post]);

    }
    
    public function index2()
    {
        $post=Post::paginate(5);
        return view('welcome',['post'=>$post]);
    }

    public function store(Request $request)
    {
        $validator=\Validator::make($request->all(), [
            "Title" =>"required",
            "Description"=>"required",
            "category"=>"required",
            "postedBy"=>"required",
            "status"=>"required"
   ]);
      if ($validator->fails())
       {
       return response()->json(['errors'=>$validator->errors()->all(),'status_code'=>500],500);
       }

       $post = new Post();
       $post->Title = $request->input('Title');
       $post->Description = $request->input('Description');
       $post->category = $request->input('category');
       $post->status = $request->input('status');
       $post->postedBy = $request->input('postedBy');
       $post->save(); 
       if($post)
       {
           return response()->json([
            'message'=>'post added successfully',
            'status_code'=>200
        ],200);
       }
       else
       {
        return response()->json(['message'=>'Server Error Occurs.Please Try Again','status_code'=>500],500);
       }
    }
    public function update(Request $request, $id)
    {
        $validator=\Validator::make($request->all(), [
            "Title"=>"required",
            "Description"=>"required",
            "category"=>"required",
            "postedBy"=>"required",
            "status"=>"required"
   ]);
      if ($validator->fails())
       {
       return response()->json(['errors'=>$validator->errors()->all(),'status_code'=>500],500);
       }

       $post = Post::find($id);
       $post->Title = $request->Title;
       $post->Description = $request->input('Description');
       $post->category = $request->input('category');
       $post->status = $request->input('status');
       $post->postedBy = $request->input('postedBy');
       $post->save(); 
       if($post)
       {
           return response()->json([
            'message'=>'post updated successfully',
            'status_code'=>200
        ],200);
       }
       else
       {
        return response()->json(['message'=>'Server Error Occurs.Please Try Again','status_code'=>500],500);
       }

    }
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        if($post)
        {
            return response()->json([
             'message'=>'post deleted successfully',
             'status_code'=>200
         ],200);
        }
        else
        {
         return response()->json(['message'=>'Server Error Occurs.Please Try Again','status_code'=>500],500);
        }
    }
    public function search(Request $request)
    {
        $search_text = $request->input('search_text');
        $result=DB::table('posts')->where('Title', "like", "%$search_text%")->get();
        return response()->json($result);
    }

}
