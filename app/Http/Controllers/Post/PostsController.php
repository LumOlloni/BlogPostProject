<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostValidation;
use App\Post;


class PostsController extends Controller
{
    public function index(){
        return view('UserTemplate.create');
    }

    public function store(PostValidation $request){
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->slug = $request->input('slug');
        $post->image = "Hello ";
        $post->imageCompress = "Hello ";
        $post->published = 0;

        $post->save();
        return redirect();
    }
}
