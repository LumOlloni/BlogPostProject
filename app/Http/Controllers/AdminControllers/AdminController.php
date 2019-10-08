<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
   public function login(Request $request){

    $credentials = [ 'email' => $request->email , 'password' => $request->password ];
  
    if(Auth::attempt($credentials,$request->remember)){

        return view('admintemplate.index');

    }
   }


}
