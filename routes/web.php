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

        Route::get('/admin/home' ,'Admin\AdminController@index' );
        Route::get('/admin/approve' , "Admin\AdminController@approve");
        
        Route::get('/admin/approveComments' , "Admin\AdminController@comments");

        Route::post('/admin/approveComments/{id}' ,"Admin\AdminController@approveComment" );

        Route::post('/admin/approvePost/{id}' ,"Admin\AdminController@approvePost" );

        Route::resource('/admin/category' , "Admin\CategoryController"); 
    });

        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('posts' , "FrontEnd\PostController");
        Route::get('/home/{slug}' , ['as' => 'post.single' , 'uses' => "FrontEnd\PostController@getSingle"] )->where('slug' , '[\w\d\-\_]+');
        Route::resource('comments' ,"FrontEnd\CommentController");
        Route::post('/home/search' , "FrontEnd\PostController@search")->name('search');

});

