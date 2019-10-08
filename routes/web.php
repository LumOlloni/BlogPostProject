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
    
    Route::get('/', function () {
        return view('usertemplate.index');
    });
    Auth::routes();
   
});
Auth::routes(['verify' => true]);

Route::post('/admin/home' , "AdminControllers\AdminController@login")->name("loginAdmin");
// Protect routes with middleware Auth
Route::group(['middleware' => ['auth']] , function ()
{
   
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts' , "FrontEndControllers\PostController");
   
});

