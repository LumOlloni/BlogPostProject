<?php

namespace App\Http\Controllers;


use App\Post;
use App\User;
use Auth;

use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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

    public function getNotFriends()
    {
        $not_friends = User::where('id', '!=', Auth::user()->id);

        if (Auth::user()->friends->count()) {
            $not_friends->whereNotIn('id', Auth::user()->friends->modelKeys());
        }

        $not_friends = $not_friends->get();

        return response()->json($not_friends);
    }

    public function sortPostDate()
    {
        $postDate = Post::orderBy('created_at', 'ASC')->get();
        return view('frontend.template.sortPost')->withPostDate($postDate);
    }
}
