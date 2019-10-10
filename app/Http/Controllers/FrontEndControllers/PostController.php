<?php

namespace App\Http\Controllers\FrontEndControllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostValidation;
use App\Category;
use App\Comment;
use Intervention\Image\Facades\Image;
use App\Post;
use Auth;



class PostController extends Controller
{
    public function index()
    {   
        
        $post = Post::where('published' , '1')->paginate(10);
        return view('frontend.template.post')->with('post' ,  $post);
    }

    public function create(){
        $cat = Category::all();
        return view('frontend.template.create')->with('category' , $cat);
    }

    public function getSingle($slug){
        $post = Post::where('slug' , '=' , $slug)->first();
        $comment = Comment::where('published' , '1')->get();

        return view('frontend.template.show')->with(['post' => $post , 'comment' => $comment]);
    }



    public function store(PostValidation $request){
      
        $post = new Post;
        $post->slug = $request->input('slug'); 
        $post->title = $request->input('title'); 
        $post->body = $request->input('description'); 
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
     
        $post->published = 0;

        if ($request->hasFile('img')) {

             $files = $request->file('img');
            
            // for save original image
            $ImageUpload = Image::make($files);
            $originalPath = public_path('/images/');
            $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
             
            // for save thumnail image
            $thumbnailPath = public_path('/thumbnail/');
            $ImageUpload->resize(250,125);
            $ImageUpload = $ImageUpload->save($thumbnailPath.time().$files->getClientOriginalName());
         
             $post->image = time().$files->getClientOriginalName(); 
        }

         $post->save();
         toastr()->success('Post has succefully created please wait admin confirmation');
         
        return redirect()->route("posts.create");
    }
}
