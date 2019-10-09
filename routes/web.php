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
        return view('admintemplate.login');
    });
    Route::post('/admin' , "AdminControllers\AdminController@login")->name("loginAdmin");
    
    Route::get('/', function () {
        return view('usertemplate.index');
    });
    Auth::routes();
   
});
Auth::routes(['verify' => true]);



// Protect routes with middleware Auth
Route::group(['middleware' => ['auth']] , function ()
{

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin/home' ,'AdminControllers\AdminController@index' );
        Route::get('/admin/approve' , "AdminControllers\AdminController@approve");

        Route::post('/admin/approvePost/{id}' ,"AdminControllers\AdminController@approvePost" );
    });


    Route::group(['middleware' => ['user']], function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('posts' , "FrontEndControllers\PostController");
    });

});

