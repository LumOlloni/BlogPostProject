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
        $post = Post::findOrFail($request->post_id);
        $comment  = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
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

  
}
