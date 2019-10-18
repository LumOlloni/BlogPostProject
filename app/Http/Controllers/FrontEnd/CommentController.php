<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentsValidation;
use Spatie\Activitylog\Contracts\Activity;

class CommentController extends Controller
{
    public function store(CreateCommentsValidation $request){
      
   
        $comment  = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->body = $request->comment;
        $comment->published = 0;

        $comment->save();
        activity()
        ->performedOn( $comment)
     ->causedBy(Auth::user()->id)
        ->withProperties(['id' => $comment->id , 'body' => $comment->body])
        ->log('Commented Created Succefully !');
        \toastSuccess("Comment add Succefully please waint for admin confrimation");
      return redirect()->route('posts.index');
    }

    public function destroy($id){

      $comment = Comment::find($id);

      if ($comment->user_id != Auth::user()->id) {
       
        return redirect()->route('posts.index');

      }
      else {
        
        $comment->delete();
        activity()
          ->performedOn( $comment)
       ->causedBy(Auth::user()->id)
          ->withProperties(['comment' => 'comment deleted'])
          ->log('Commented deleted Succefully !');
        \toastSuccess("Comment Deleted");
        return redirect()->route('posts.index');
      }

      
    }

    public function index(){
    
      $comment = Comment::join('users' , 'comments.user_id' , '=' , 'users.id')
      ->join('posts' , 'comments.post_id' , '=' , 'posts.id')
      ->select(['comments.id' , 'comments.body','users.name','posts.title' , 'comments.published']);
      if(request()->ajax()) {

        return datatables()->of($comment)
        ->addColumn('action', function($comment){
          $html='';
          if($comment->published==0){
           
              $html.='
              <a href="javascript:void(0);" id="show-comment" data-toggle="tooltip" data-original-title="show" data-id="'. $comment->id.'" class=" btn btn-warning ">
              Show
              </a>
              <a href="javascript:void(0);" id="aprove" data-toggle="tooltip" data-original-title="show" value="1" data-id="'. $comment->id.'" class=" manipulate btn btn-success button  ">
              Accept
            </a>
            <a href="javascript:void(0);" id="reject" data-toggle="tooltip" data-original-title="Delete" value="2" data-id="'. $comment->id.'" class="delete btn btn-danger button ">
              Reject
            </a>';
          }if ($comment->published==1) {

              $html.='<a href="javascript:void(0);" id="show-comment" data-toggle="tooltip" data-original-title="show" data-id="'. $comment->id.'" class=" btn btn-warning">
              Show
            </a>';
          }
          if ($comment->published==2) {
            $html.= 'This Comment is Rejected';
          }
           return $html;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }
    return view('admin.template.comment');
    }
}
