<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Post;
use Blade;
class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $post = new Post;

       Blade::if('mypost' , function($user , $post){
           if ($user->id == $post->user_id) {
               return true;
           } 
           else {
               return false;
           }
       });
    }
}
