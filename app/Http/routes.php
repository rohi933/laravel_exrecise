<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





	
	Route::get('/', function () {
    return view('welcome');
});
   Route::post('upload', 'UploadController@upload');
   Route::get('search','SearchController@index');
   Route::post('update','UpdateController@update');
   Route::get('/dashboard', 'HomeController@index');
   Route::get('/home',function(){
   if(Auth::check()){
    return Redirect::to("/dashboard");
   }
   else
    return view('auth/login');
});
Route::auth();
 //Route::get('search','SearchController@index');



