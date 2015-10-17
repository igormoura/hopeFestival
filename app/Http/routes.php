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
    return view('auth/login');
});

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function ()
{
	Route::group(['prefix' => 'v1'], function ()
	{
    require Config::get('generator.path_api_routes');
	});
});

Route::resource('applications','ApplicationController');
Route::resource('archives','ArchiveController');
Route::resource('customers','CustomerController');
Route::resource('versions','VersionController');
Route::resource('counselors', 'CounselorController');
Route::get('home', 'HomeController@index');

Route::post('/register', 'CounselorController@register');
Route::post('/checking', 'CounselorController@checking');
Route::post('/checkingCodeBar', 'CounselorController@checkingCodeBar');
Route::post('/counselors', 'CounselorController@search');



Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);