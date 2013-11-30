<?php

class FlightController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('flights');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function filterFlights() {
		$flightDate 	= Input::get('flight-date');
		$departure 		= Input::get('departure');
		$destination 	= Input::get('destination');

		// Find the codes of the airports we are departing from and going to
		$depCode = DB::table('airline')->where('city', '=', $departure)->pluck('airline_code');
		$arrCode = DB::table('airline')->where('city', '=', $destination)->pluck('airline_code');
 
		// If flexible date is not checked
		if (Input::get('flexible-date') == NULL) {					
		
			return View::make('flights.index', array(
				'flights'	=> $filterFlights
				));
		}
		else { 

			// have to figure out what the possible dates are
			$twoDaysBefore;
			$previousDay;
			$flightDate;
			$nextDay;
			$twoDaysAfter;

			return View::make('flights.index', array(
				'twoDaysBefore'	=> $twoDaysBefore,
				'previousDay'	=> $previousDay,
				'flightDate' 	=> $flightDate,
				'nextDay'		=> $nextDay,
				'twoDaysAfter'	=> $twoDaysAfter
				));

		}
	}

}