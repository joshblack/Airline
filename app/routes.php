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

Route::get('login', function() {
	return View::make('login');
});

Route::post('login', 'AuthController@login');

Route::get('flights', 'HomeController@bookFlight');
Route::post('flights', 'FlightController@filterFlights');

Route::get('flights/available', 'FlightController@');
