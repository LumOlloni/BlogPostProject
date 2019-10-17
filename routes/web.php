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
            // Get Route
            Route::get('/home' ,'Admin\AdminController@index' );
            Route::get('/approve' , "Admin\AdminController@approve");
            Route::get('/approveComments' , "Admin\AdminController@comments");
            Route::get('/deleteAll',"Admin\AdminController@deleteComment");
            Route::get('/sort' , "Admin\AdminController@sort" );
            Route::get('user' , "Admin\UserController@anyData" )->name('get.users');
            Route::get('users/{id}/show' , 'Admin\UserController@show');
            Route::get('category/{id}/show' , 'Admin\CategoryController@show');

            Route::post('/approveComments/{id}' ,"Admin\AdminController@approveComment" );
            Route::post('/approvePost/{id}' ,"Admin\AdminController@approvePost" );
            Route::post('/updatePost' ,"Admin\AdminController@updateOrder");
            Route::delete('/users/delete/{id}', 'Admin\UserController@destroy');
            Route::delete('/category/delete/{id}', 'Admin\CategoryController@destroy');
            Route::resource('category' , "Admin\CategoryController"); 
            Route::resource('users' , "Admin\UserController");

           
        });
    });

    // Logout Route
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    // Route prefix home url
     Route::prefix('home')->group(function () {  
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/sortDate' , 'HomeController@sortPostDate' )->name('sortDate');
        Route::get('/sortAdmin' , 'FrontEnd\PostController@sortPostAdmin' )->name('sortAdmin');
        Route::get('/{slug}' , ['as' => 'post.single' , 'uses' => "FrontEnd\PostController@getSingle"] )->where('slug' , '[\w\d\-\_]+');
        Route::post('/search' , "FrontEnd\PostController@search")->name('search');
    });
    
    // Route Resource
        Route::resource('posts' , "FrontEnd\PostController");
        Route::resource('comments' ,"FrontEnd\CommentController");

});

