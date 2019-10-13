<?php

namespace App\Http\Controllers\FrontEnd;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostValidation;
use App\Http\Requests\EditPostValidation;
use App\Category;
use App\Comment;
use Intervention\Image\Facades\Image;
use App\Post;
use Auth;
use Storage;
use File;
use App\Classes\BodyLimit;
use App\Classes\ImageService;
use DB;
use Spatie\Activitylog\Contracts\Activity;



class PostController extends Controller
{
    public function index()
    {   
         $limit = new BodyLimit;
        $post = Post::where('published' , '1')->paginate(5);
        $cat = Category::all();
        return view('frontend.template.post')->withPost($post)->withCat($cat)->withLimit($limit);
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

    public function update(EditPostValidation $request ,$id){

        $post = Post::find($id);
        if ($post->user_id != Auth::user()->id) {
            toastr()->warning('You cant edit this post');
       
            return redirect()->route("posts.index");
        }
        else {

            $post->slug = $request->input('slug'); 
            $post->title = $request->input('title'); 
            $post->body = $request->input('description'); 
            $post->user_id = Auth::id();
            $post->category_id = $request->category;
    
            $post->published = 1;
            $imageUpload = new ImageService;
            $imageUpload->uploadEditImage('img' , $post , $request);
    
            $post->update();
    
            activity()
                ->performedOn($post)
                ->causedBy(Auth::user()->id)
                ->withProperties(['id' => $post->id , 'title' => $post->title , 'body'=>$post->body , 'slug' => $post->slug])
                ->log('Update post  name '. $post->name .'' );
    
              
    
            toastr()->success('Post Update Succefully');
           
            return redirect()->route("posts.index");
        }
        


    }

    public function edit($id){
        $post = Post::find($id);
        $categories = Category::all();
       
        return view('frontend.template.edit')->withPost($post)->withCategories( $categories);
    }

    public function destroy($id){
        $post = Post::find($id);
        if ($post->user_id != Auth::user()->id) {
            toastr()->warning('You cant edit this post');
       
            return redirect()->route("posts.index");
        }else {

            $id = $post->id;
            $imagedelete = new ImageService;
            $imagedelete->deleteImage($post);
           
            $post->delete();
            activity()
            ->performedOn($post)
            ->causedBy(Auth::user()->id)
            ->withProperties(['deletE' => 'Delete Post'])
            ->log('Delted post');
    
            toastr()->success('Post Deleted');
            return redirect('/posts');
        }
       
    }



    public function store(PostValidation $request){
      
        $post = new Post;
        $post->slug = $request->input('slug'); 
        $post->title = $request->input('title'); 
        $post->body = $request->input('description'); 
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
     
        $post->published = 0;
        $imageUpload = new ImageService;
        $imageUpload->uploadCreateImage('img',$post,$request);

         $post->save();
         
         activity()
            ->performedOn($post)
         ->causedBy(Auth::user()->id)
            ->withProperties(['id' => $post->id , 'title' => $post->title , 'body'=>$post->body , 'slug' => $post->slug])
            ->log('Created  post');


         toastr()->success('Post has succefully created please wait admin confirmation');
         
        return redirect()->route("posts.create");
    }

    public function search(Request $request){
        
       $search = $request->search; 
       $category = $request->category;

      
      
        if ($search == '') {
            $post = Post::whereHas('category', function ($q) use ($category) {
                $q->where('categories.id',  $category);
         })->get();
        
            return view('frontend.template.search')->withPost($post);
        }
        else if ($search != ''){

            $post = Post::where('title' , 'LIKE','%'.$search.'%' )
               ->whereHas('category', function ($q) use ($category) {
                $q->where('categories.id',  $category);
            })->get();
          
            return view('frontend.template.search')->withPost($post);
        }
        else {

            toastr()->danger('No Post Found');
            return redirect()->back();
        }
        
    }
}
