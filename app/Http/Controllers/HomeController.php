<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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
     
        $postDate = Post::orderBy('created_at', 'ASC')->get();
        return view('frontend.template.sortPost')->withPostDate($postDate);
    }
   
}
