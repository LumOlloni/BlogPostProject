<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Post;

class AdminController extends Controller
{
    public function index(){
        return view('admintemplate.index');
    }

   public function login(Request $request){

    $credentials = [ 'email' => $request->email , 'password' => $request->password ];
  
    if(Auth::attempt($credentials,$request->remember)){

       return redirect('/admin/home');
    }
   }

   public function approvePost(Request $request,$id){

        $post = Post::find($id);
       $udateValue =  $request->updateValue;
        if ($udateValue == 1) {
            $post->published =  $udateValue;

            toastr()->success('Post has succefully confirmation');
            $post->save();
            return response()->json(['success' => true]);
        }
        else if($udateValue == 2){
            $post->published =  $udateValue;

            toastr()->warning('Post has rejected');
            $post->save();
            return response()->json(['success' => true]);
        }
        else {
            toastr()->danger('Error request');
            return response()->json(['error' => true]);
        }
      
    }

   public function approve()
   {
        $post = Post::where('published' , '0')->get();
        return view('admintemplate.approve')->with('post' , $post);
   }

  


}
