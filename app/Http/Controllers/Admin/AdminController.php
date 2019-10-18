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
use Response;
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

   public function showPost($id){

        $post_id = array('id' => $id);
        $post  = Post::where($post_id)->first();
        return view('admin.template.showpost')->with('post' , $post);
   }

   public function approvePost(Request $request,$id){

        $post = Post::find($id);
       $updateValue =  $request->btn;
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
           

            return response()->json(['error' => true]);
        }
      
    }

   public function  showComment($id){

        $comment_id = array('id' => $id);
        $comment  = Comment::where($comment_id)->first();
        return view('admin.template.showcomment')->with('comment' , $comment);
   }

   public function approve()
   {
    $post = Post::join('users' , 'posts.user_id' , '=' , 'users.id')
    ->select(['posts.id' , 'posts.body','users.name','posts.title' , 'posts.published']);
    if(request()->ajax()) {

      return datatables()->of($post)
      ->addColumn('action', function($post){
        $html='';
        if($post->published==0){
         
            $html.='
            <a href="javascript:void(0);" id="show-comment" data-toggle="tooltip" data-original-title="show" data-id="'. $post->id.'" class=" btn btn-warning ">
            Show
            </a>
            <a href="javascript:void(0);" id="aprove" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $post->id.'" class=" manipulate btn btn-success button  ">
            Accept
          </a>
          <a href="javascript:void(0);" id="aprove" data-toggle="tooltip" data-original-title="show" value="2" data-id="'. $post->id.'" class=" manipulate btn btn-danger button">
            Reject
          </a>
          <a href="javascript:void(0);" id="delete" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $post->id.'" class=" manipulate btn btn-danger button">
            Delete
          </a>
          ';
        }if ($post->published==1) {

            $html.='<a href="javascript:void(0);" id="show-comment" data-toggle="tooltip" data-original-title="show" data-id="'. $post->id.'" class=" btn btn-warning">
            Show
          </a>
            <a href="javascript:void(0);" id="aprove" data-toggle="tooltip" data-original-title="show" value="2" data-id="'. $post->id.'" class=" manipulate btn btn-danger button  ">
            Reject
          </a>
          <a href="javascript:void(0);" id="delete" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $post->id.'" class=" manipulate btn btn-danger button">
            Delete
          </a>
          ';
        }
        if ($post->published==2) {

          $html.= 'This Posts is Rejected <br>
                <a href="javascript:void(0);" id="aprove" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $post->id.'" class=" manipulate btn btn-success button  ">
                Accept
                </a>
                <a href="javascript:void(0);" id="delete" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $post->id.'" class=" manipulate btn btn-danger button">
            Delete
          </a>
          ';
        
        }
         return $html;
      })
      ->rawColumns(['action'])
      ->addIndexColumn()
      ->make(true);
  }
        return view('admin.template.approve');
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
    

    public function delete($id){

        $post = Post::where('id',$id)->first();
        $post->deleteImage($post);
        $post->delete();

 
        return Response::json($post);
    }

    public function approveComment(Request $request,$id){
      
        $comment = Comment::find($id);
        if(request()->ajax()) {
        $udateValue =  $request->input('btn');
        if ($udateValue == 1) {
            $comment->published =  $udateValue;
            $comment->save();
            activity()
            ->performedOn( $comment)
         ->causedBy(Auth::user()->id)
            ->withProperties(['comment' => 'comment aprove'])
            ->log('Comment Aprove !!');

            toastr()->success('Comment has succefully confirmation');
            
            return response()->json(['success' => true]);
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

            return response()->json(['success' => true]);
        }
        else {

            toastr()->warning('Error 404');

            return response()->json(['error' => true]);
        }
    }
       
    }


}
