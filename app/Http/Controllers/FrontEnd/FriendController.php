<?php

namespace App\Http\Controllers\FrontEnd;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FriendController extends Controller
{
    public function store(Request $request)
    {
        $friend_id = $request->id;
        $user = new User;
        $user->addFriend(Auth::id(), $friend_id);
        return response()->json(['success' => 'true']);
    }

    public function getFriends($id)
    {
        $user = User::with('friends')->where('id', Auth::id())->get();

        return response()->json($user);
    }
}
