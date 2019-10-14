<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Classes\BodyLimit;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.template.home');
    }

    public function sortPostDate(){
        $limit = new BodyLimit;
        $postDate = Post::orderBy('created_at', 'ASC')->get();
        return view('frontend.template.sortPost')->withPostDate($postDate)->withLimit($limit);
    }
    public function sortPostAdmin(){
        $postAdmin = Post::orderBy(DB::raw('RAND()'))->take(4)->get();
        return view('frontend.template.sortPost')->withPostAdmin($postAdmin);
    }
}
