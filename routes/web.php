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
Route::group(['middleware' =>'guest'], function()
{
	Route::any('/', [
	'uses' => 'LoginController@home',
	'as' => 'login'
]);

Route::view('/register','register');

Route::post('/loginnow', "LoginController@loginnow");

Route::view('/login', "login");

  
});

Route::get('/logout', "LoginController@logout");

Route::group(['middleware' =>'auth'], function()
{
	 Route::get('/profile', [
      	'uses'=>'LoginController@getProfile',
      	'as'=> 'user.dashboard'
    ]);

	 Route::get('showUsers/{id}', [
      	'uses'=>'ViewController@getUsers',
      	'as'=> 'showUsers'
    ]);

	  Route::get('showDeps/{id}', [
      	'uses'=>'ViewController@getDeps',
      	'as'=> 'showDeps'
    ]);

	 Route::any('/chooseuser', "UserController@chooseuser_role");

	 Route::any('/createuserrole', "UserController@createuserrole");

	 Route::get('/create_user/{id}', "UserController@create_user");

	 Route::any('/create_dep', "UserController@postcreate_dep");

	 Route::any('/create_depnow', "UserController@create_depnow");

	 Route::post('/register_role', "RegisterController@register_role");

	 Route::post('/register_dep', "RegisterController@register_dep");

	 Route::post('/registernow', "RegisterController@registernow");

	 Route::post('/deletenow', "UserController@deletenow");

	 Route::post('/updatenow', "UserController@updatenow");

	 Route::post('/deleteuser', "UserController@deleteuser");

	 Route::any('/addpatient', "PatientController@addpatient");

	 Route::post('/refer', "PatientController@refer");


});