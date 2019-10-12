<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Protect routes with middleware Guest
Route::group(['middleware' => ['guest']] , function ()
{
    Route::get('/admin' , function(){
        return view('admin.template.login');
    });
    Route::post('/admin' , "Admin\AdminController@login")->name("loginAdmin");
    
    Route::get('/', function () {
        return view('frontend.template.index');
    });
    Auth::routes();
   
});
Auth::routes(['verify' => true]);



// Protect routes with middleware Auth
Route::group(['middleware' => ['auth']] , function ()
{

    Route::get('locale/{locale}' , function($locale){
        Session::put('locale' , $locale);
        return redirect()->back();
    });

    Route::group(['middleware' => ['admin']], function () {
        // Route Prefix for Admin Url
        Route::prefix('admin')->group(function () {  
            Route::get('/home' ,'Admin\AdminController@index' );
            Route::get('/approve' , "Admin\AdminController@approve");
            
            Route::get('/approveComments' , "Admin\AdminController@comments");
            Route::get('/deleteAll',"Admin\AdminController@deleteComment");

            Route::post('/approveComments/{id}' ,"Admin\AdminController@approveComment" );

            Route::post('/approvePost/{id}' ,"Admin\AdminController@approvePost" );

            Route::resource('category' , "Admin\CategoryController"); 
        });
    });

    // Route prefix home url
     Route::prefix('home')->group(function () {  
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/sortDate' , 'HomeController@sortPostDate' )->name('sortDate');
        Route::get('/sortAdmin' , 'HomeController@sortPostAdmin' )->name('sortAdmin');
        Route::get('/{slug}' , ['as' => 'post.single' , 'uses' => "FrontEnd\PostController@getSingle"] )->where('slug' , '[\w\d\-\_]+');
        Route::post('/search' , "FrontEnd\PostController@search")->name('search');
    });

    // Route Resource
        Route::resource('posts' , "FrontEnd\PostController");
        Route::resource('comments' ,"FrontEnd\CommentController");

});

