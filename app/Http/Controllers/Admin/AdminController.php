<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\DeleteComment;
use Auth;
use App\Post;
use App\User;
use Carbon\Carbon;
use App\Comment;
use Spatie\Activitylog\Contracts\Activity;

class AdminController extends Controller
{
    public function index(){
        return view('admin.template.index');
    }

   public function login(Request $request){
    $user = new User;
    $credentials = [ 'email' => $request->email , 'password' => $request->password ];
  
    if(Auth::attempt($credentials,$request->remember)){
        activity()
        ->performedOn( $user)
     ->causedBy(Auth::user()->id)
        ->withProperties(['logged in' => 'logged in succefully'])
        ->log('You logged in succefully !!');

       return redirect('/admin/home');
    }
    else {
        \toastWarning("Username or Password are incorrect");
        return redirect('/admin');
    }
   }

   public function deleteComment(){
        
       $jobs = (new DeleteComment() )

       ->delay(Carbon::now()->addSeconds(5));

       dispatch($jobs);

       \toastWarning("Comments deleted");

       return redirect('/admin/home');
       
   }

   public function approvePost(Request $request,$id){

        $post = Post::find($id);
       $updateValue =  $request->updateValue;
        if ($updateValue == 1) {
            $post->published =  $updateValue;

            toastr()->success('Post has succefully confirmation');

            $post->save();

            activity()
            ->performedOn( $post)
            ->causedBy(Auth::user()->id)
            ->withProperties(['aprove' => 'aprove post'])
            ->log('Post Approve Succefully');

            return response()->json(['success' => true]);
        }
        else if($updateValue == 2){
            $post->published =  $updateValue;

            toastr()->warning('Post has rejected');
            $post->save();

            activity()
            ->performedOn( $post)
            ->causedBy(Auth::user()->id)
            ->withProperties(['aprove' => 'rejected post'])
            ->log('Post rejected !!');
            
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

    public function sort(){
        $post = Post::orderBy('order','ASC')->get();
        return view("admin.template.sort")->with('post' , $post);
    }

    public function updateOrder(Request $request){
        $post = Post::all();

        foreach ($post as $p ) {
            $p->timestamps = false;
            $id = $p->id;

            foreach ($request->order as $order) {
                
                if ($order['id'] == $id) {
                    $p->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }


    public function approveComment(Request $request,$id){

        $comment = Comment::find($id);
        $udateValue =  $request->updatecomment;
        if ($udateValue == 1) {
            $comment->published =  $udateValue;
            $comment->save();
            activity()
            ->performedOn( $comment)
         ->causedBy(Auth::user()->id)
            ->withProperties(['comment' => 'comment aprove'])
            ->log('Comment Aprove !!');

            toastr()->success('Comment has succefully confirmation');
            
            return redirect('admin/approveComments');
        }
        
        else if($udateValue == 2){

            $comment->published =  $udateValue;
            $comment->save();
            activity()
            ->performedOn( $comment)
            ->causedBy(Auth::user()->id)
            ->withProperties(['comment' => 'comment rejected'])
            ->log('Comment Rejected !!');

            toastr()->warning('Comment rejected');

            return redirect('admin/approveComments');
        }
        else {

            toastr()->warning('Error 404');

            return redirect('admin/approveComments');
        }
       
    }


}
