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
    Route::post('/admin' , "AdminControllers\AdminController@login")->name("loginAdmin");
    
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

        Route::get('/admin/home' ,'AdminControllers\AdminController@index' );
        Route::get('/admin/approve' , "AdminControllers\AdminController@approve");
        
        Route::get('/admin/approveComments' , "AdminControllers\AdminController@comments");

        Route::post('/admin/approveComments/{id}' ,"AdminControllers\AdminController@approveComment" );

        Route::post('/admin/approvePost/{id}' ,"AdminControllers\AdminController@approvePost" );

        Route::resource('/admin/category' , "AdminControllers\CategoryController"); 
    });

        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('posts' , "FrontEndControllers\PostController");
        Route::get('/home/{slug}' , ['as' => 'post.single' , 'uses' => "FrontEndControllers\PostController@getSingle"] )->where('slug' , '[\w\d\-\_]+');
        Route::resource('comments' ,"FrontEndControllers\CommentController");

});

