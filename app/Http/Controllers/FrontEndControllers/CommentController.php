<?php

namespace App\Http\Controllers\FrontEndControllers;

use App\Http\Controllers\Controller;
use Auth;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentsValidation;

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
        \toastSuccess("Comment add Succefully please waint for admin confrimation");
      return redirect()->route('posts.index');

    }
}
