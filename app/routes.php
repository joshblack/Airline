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

	Route::get('agents/flights/new', 'FlightController@create');
	Route::post('agents/flights/new', 'FlightController@store');

	Route::post('agents/flights/flightlegs/new', 'FlightController@storeFlightLegs');

	Route::get('agents/flights/{tripNum}', 'FlightController@show');
	
	Route::get('agents/flights/{tripNum}/edit', 'FlightController@edit');
	Route::post('agents/flights/{tripNum}/edit', 'FlightController@update');

	Route::post('agents/flights/{tripNum}/delete', 'FlightController@destroy');

	Route::get('agents/reservations', 'AgentController@showReservations');
	
	Route::get('agents/reservations/{reservationId}/edit', 'AgentController@edit');
	Route::post('agents/reservations/{reservationId}/edit', 'AgentController@update');

	Route::post('agents/reservations/{reservationId}/delete', 'AgentController@destroy');
	
	Route::post('flights', 'FlightController@filterFlights');

	Route::get('reservation/{departure}/{destination}/{time}', 'FlightController@showReservation');
	Route::post('reservation', 'FlightController@makeReservation');
	// Route::get('payment', 'FlightController@makePayment');
	Route::post('payment', 'FlightController@makePayment');

	Route::get('agents/flights', 'AgentController@showIndex');

	Route::get('client/{id}/flights', 'FlightController@showFlights');
	
});
