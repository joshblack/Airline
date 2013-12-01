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
		return View::make('flights.create');
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

		$formatFlightDate = new Datetime($flightDate);
		$formatFlightDate->format("g:i A M j, Y ");

		// Find the codes of the airports we are departing from and going to
		$depCode = DB::table('airline')->where('city', '=', $departure)->pluck('airline_code');
		$arrCode = DB::table('airline')->where('city', '=', $destination)->pluck('airline_code');
 
		// If flexible date is not checked
		if (Input::get('flexible-date') == NULL) {	

			$tripNumber = DB::table('trip')
				->where('departure', '=', $departure)
				->where('destination', '=', $destination)
				->pluck('tripNum');

			$flightLegTime = DB::table('flightleg')
				->where('tripNum', '=', $tripNumber)
				->where('departureCode', '=', $depCode)
				->pluck('departureTime');

			$formatFlightLegTime = new Datetime($flightLegTime);
			$formatFlightLegTime->format("g:i A M j, Y ");

			if ($formatFlightLegTime != $formatFlightDate) {
				$tripInfo = 1;
			}
			else {
				$tripType = 1;

				$tripInfo = DB::table('trip')
					->where('departure', '=', $departure)
					->where('destination', '=', $destination)
					->get();
			}

			// tell me how do we get a flight given above information.
			return View::make('flights.index', array(
				'tripInfo'	=> $tripInfo,
				'flightDate' => $formatFlightLegTime,
				'tripType'	=> $tripType
				));
		}
		else { 

			$tripType = 0;
			// RANGE
			$tripNumber = DB::table('trip')
				->where('departure', '=', $departure)
				->where('destination', '=', $destination)
				->lists('tripNum');


			$flightArray = array();

			foreach ($tripNumber as $trip) {

				$flightLegTime = DB::table('flightleg')
					->where('tripNum', '=', $trip)
					->where('departureCode', '=', $depCode)
					->pluck('departureTime');

				array_push($flightArray, $flightLegTime);
			}
			
			$beforeTime = new Datetime($formatFlightDate->format("g:i A M j, Y "));
			$beforeTime->sub(new DateInterval('P4D'));

			$afterTime = new Datetime($formatFlightDate->format("g:i A M j, Y "));
			$afterTime->add(new DateInterval('P4D'));

			$tripArray = array();

			foreach ($flightArray as $flight) {
				$formatFlight = new Datetime($flight);
				$formatFlight->format("g:i A M j, Y ");

				if ($formatFlight > $afterTime || $formatFlight < $beforeTime) {
					$tripInfo = 2;
				}
				else {
					$tripInfo = DB::table('trip')
						->where('departure', '=', $departure)
						->where('destination', '=', $destination)
						->get();

					$tripInfo['flightTime'] = $flight;

					array_push($tripArray, $tripInfo);
				}	
			}

			return View::make('flights.index', array(
				'tripInfo'	=> $tripArray,
				'tripType' => $tripType
				));

		}
	}

	public function showReservation($departure, $destination, $time) {

		$depCode = DB::table('airline')->where('city', '=', $departure)->pluck('airline_code');

		$tripNumber = DB::table('trip')
				->where('departure', '=', $departure)
				->where('destination', '=', $destination)
				->lists('tripNum');

		$depTime = new Datetime($time);
		$depTime->format("g:i A M j, Y ");


		foreach ($tripNumber as $trip) {

			$flightLegTime = DB::table('flightleg')
				->where('tripNum', '=', $trip)
				->where('departureCode', '=', $depCode)
				->pluck('departureTime');

			$formatFlightLegTime = new Datetime($flightLegTime);
			$formatFlightLegTime->format("g:i A M j, Y ");

			if ($formatFlightLegTime == $depTime) {
				$flightTripNumber = $trip;
				break;
			}
		}

		return View::make('reservation', array(
				'tripNum' => $flightTripNumber
			));
		
	}

	public function makeReservation() {
		$input = Input::get();

		$date = date('Y-m-d H:i:s');

		$reservationNum = rand(1, 999);

		$reservationNums = DB::table('reservation')
			->lists('reservationNum');

		while (in_array($reservationNum, $reservationNums))
			$reservationNum = rand(1, 999);

		$reservation = array(
			'reservationNum'	=> $reservationNum,
			'email'	=> $input['email'],
			'name' => $input['fullName'],
			'address' => $input['address'],
			'phone'	=> $input['phoneNumber'],
			'reservationDate' => $date
			);

		DB::table('reservation')->insert($reservation);

		return View::make('payment', array(
			'reservationNum' => $reservationNum,
			'tripNum'	=> $input['tripNum']
			));
	}

	public function makePayment() {
		$input = Input::get();
		$date = date('Y-m-d H:i:s');

		$transactionNum = rand(1, 999);

		$transactionNums = DB::table('payment')
			->lists('transactionNum');

		while (in_array($transactionNum, $transactionNums))
			$transactionNum = rand(1, 999);

		$payment = array(
			'transactionNum' => $transactionNum,
			'paymentDate' => $date,
			'account' => $input['account'],
			'nameOnAccount' => $input['accountName'],
			'reservationNum' => $input['reservationNum'],
			'tripNum' => $input['tripNum']
			);

		DB::table('payment')->insert($payment);

		// decreasing amount of seats on each leg

		$numSeats = DB::table('flightleg')
			->where('tripNum', '=', $input['tripNum'])
			->get();

		$error = NULL;

		foreach ($numSeats as $numSeat) {
			if($numSeat->numSeatsAvail - 1 < 0)
				$error = 0;
			else {
				DB::table('flightleg')
					->where('tripNum', $numSeat->tripNum)
					->update(array('numSeatsAvail' => $numSeat->numSeatsAvail - 1));
			}
		}
		
		if ($error = NULL)
			return Redirect::to('/')->with('success', 'Your flight has been booked!');
		else 
			return Redirect::to('/')->with('error', 'Flight is full, sorry!');
	}

}