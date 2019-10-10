<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Comment;

class AdminController extends Controller
{
    public function index(){
        return view('admin.template.index');
    }

   public function login(Request $request){

    $credentials = [ 'email' => $request->email , 'password' => $request->password ];
  
    if(Auth::attempt($credentials,$request->remember)){

       return redirect('/admin/home');
    }
    else {
        \toastWarning("Username or Password are incorrect");
        return redirect('/admin');
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
        return view('admin.template.approve')->with('post' , $post);
   }
    public function comments (){

        $comment = Comment::where('published' , '0')->get();
       
        return view("admin.template.comment")->with('comment' , $comment);
    }

    public function approveComment(Request $request,$id){

        $comment = Comment::find($id);
        $udateValue =  $request->updatecomment;
        if ($udateValue == 1) {
            $comment->published =  $udateValue;
            $comment->save();
            toastr()->success('Comment has succefully confirmation');
            return redirect('admin/approveComments');
        }
        
        else if($udateValue == 2){

            $comment->published =  $udateValue;
            $comment->save();
            toastr()->warning('Comment rejected');
            return redirect('admin/approveComments');
        }
        else {
            toastr()->warning('Error 404');
            return redirect('admin/approveComments');
        }
       
    }


}
