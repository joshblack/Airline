<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('signup', function() {
	return View::make('signup');
});
Route::post('signup', 'AuthController@signup');

Route::get('login', function() {
	return View::make('login');
});

Route::post('login', 'AuthController@login');

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});

Route::group(array('before' => 'auth'), function()
{

	Route::get('profile', function() {
		return View::make('profile');
	});

	Route::get('flights', 'HomeController@bookFlight');
	Route::post('flights', 'FlightController@filterFlights');
});
