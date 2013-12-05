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
		$input = Input::get();

		$tripNum = DB::table('trip')->lists('tripNum');
		$newTripNum = rand(1, 999);

		while (in_array($newTripNum, $tripNum))
			$newTripNum = rand(1, 999);

		$departure = DB::table('airline')
			->where('city', '=', $input['departure'])
			->pluck('airline_code');

		if(!$departure)
			return Redirect::to('/agents/flights/new')->with('error', 'That departure city does not exist');

		$destination = DB::table('airline')
			->where('city', '=', $input['destination'])
			->pluck('airline_code');

		if(!$destination)
			return Redirect::to('/agents/flights/new')->with('error', 'That destination city does not exist');

		$newTrip = array(
			'tripNum' => $newTripNum,
			'airline' => $input['airline'],
			'price'	=> $input['price'],
			'departure' => $input['departure'],
			'destination' => $input['destination'],
			'numOfLegs' => $input['numOfLegs']
			);

		DB::table('trip')->insert($newTrip);

		return View::make('flights.flightlegs', array(
			'numOfLegs' => $input['numOfLegs'],
			'trip'		=> $newTrip
			));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($tripNum)
	{
		$trip = DB::table('trip')
			->where('tripNum', '=', $tripNum)
			->get();

		$numSeats = DB::table('flightleg')
			->where('tripNum', '=', $tripNum)
			->pluck('numSeatsAvail');

		return View::make('flights.show', array(
			'trip' => $trip,
			'numSeats' => $numSeats
			));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($tripNum)
	{
		$trip = DB::table('trip')
			->where('tripNum', '=', $tripNum)
			->get();

		return View::make('flights.edit', array(
			'trip'	=> $trip
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $tripNum
	 * @return Response
	 */
	public function update($tripNum)
	{
		$input = Input::get();

		$newTrip = array(
			'airline' => $input['airline'],
			'price'	=>	$input['price'],
			'departure' => $input['departure'],
			'destination' => $input['destination'],
			'numOfLegs'	=> $input['numOfLegs']
			);

		DB::table('trip')
            ->where('tripNum', $input['tripNum'])
            ->update($newTrip);

		return Redirect::to('/agents/flights')->with('success', 'Your trip information has been saved');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($tripNum)
	{
		$trip = DB::table('trip')
			->where('tripNum', '=', $tripNum)
			->get();

		$flightLegs = DB::table('flightleg')
			->where('tripNum', '=', $trip[0]->tripNum)
			->get();

		$destroy = 1;

		foreach ($flightLegs as $flight) {
			$airplaneId = DB::table('flightleg')
				->where('tripNum', '=', $flight->tripNum)
				->where('legNum', '=', $flight->legNum)
				->pluck('airplaneID');

			$numSeatsTotal = DB::table('airplane')
				->where('airplane_id', '=', $airplaneId)
				->pluck('numOfSeats');

			if ($numSeatsTotal != $flight->numSeatsAvail)
				$destroy = 0;
		}

		if ($destroy == 1)
		{	
			DB::table('trip')->where('tripNum', '=', $tripNum)->delete();
			return Redirect::to('/agents/flights')->with('success', 'Your trip has been deleted');
		}
		else {
			return Redirect::to('/agents/flights')->with('error', 'People have already booked this flight');
		}
		
	}

	public function filterFlights() {
		$flightDate 	= Input::get('flight-date');
		$departure 		= Input::get('departure');
		$destination 	= Input::get('destination');

		$formatFlightDate = new Datetime($flightDate);
		$formatFlightDate->format("g:i A M j, Y ");

		$tripType = 0;
		
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

		$id = Auth::user()->id;

		$reservation = array(
			'reservationNum'	=> $reservationNum,
			'email'	=> $input['email'],
			'name' => $input['fullName'],
			'address' => $input['address'],
			'phone'	=> $input['phoneNumber'],
			'reservationDate' => $date,
			'id' => $id
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
			{
				$error = 0;
			}
			else {
				DB::table('flightleg')
					->where('tripNum', $numSeat->tripNum)
					->update(array('numSeatsAvail' => $numSeat->numSeatsAvail - 1));
			}
		}
		
		if ($error == NULL) {
			//$user = Auth::user()->id;
			//DB::table('users')
			//	->where('id', '=', $user)
			//	->update(array('tripNum' => $input['tripNum']));

			return Redirect::to('/')->with('success', 'Your flight has been booked!');
		}
		else 
			return Redirect::to('/')->with('error', 'Flight is full, sorry!');
	}

	public function storeFlightLegs() {
		$input = Input::get();

		$numOfLegs = DB::table('trip')
			->where('tripNum', '=', $input['tripNum'])
			->pluck('numOfLegs');

		$i = 1;

		while ($numOfLegs > 0) {

			$numSeats = DB::table('airplane')
				->where('airplane_id', '=', $input['airplane' . $i])
				->pluck('numOfSeats');

			if(!$numSeats)
				return Redirect::to('agents/flights')->with('error', 'No airplane exists with that ID');

			$departure = new Datetime($input['departure' . $i .'-date']);
			$destination = new Datetime($input['destination' . $i . '-date']);

			$depCode = DB::table('airline')
				->where('city', '=', $input['departure' . $i])
				->pluck('airline_code');

			if(!$depCode)
				return Redirect::to('agents/flights')->with('error', 'No flight available at that departure location');

			$arrCode = DB::table('airline')
				->where('city', '=', $input['destination' . $i])
				->pluck('airline_code');

			if(!$arrCode)
				return Redirect::to('agents/flights')->with('error', 'No flight available at that destination location');

			$flightLeg = array(
				'legNum' => $input['flightLeg' . $i],
				'numSeatsAvail' => $numSeats,
				'flightLegDate' => $departure,
				'arrivalTime' => $destination,
				'departureTime' => $departure,
				'airplaneID' => $input['airplane' .$i],
				'arrivalCode' => $arrCode,
				'departureCode' => $depCode,
				'tripNum' => $input['tripNum']
				);

			DB::table('flightLeg')->insert($flightLeg);

			$i++;
			$numOfLegs--;
		}

		return Redirect::to('agents/flights')->with('success', 'New Flight information saved');
	}

	public function showFlights($id) {
		$reservations = DB::table('reservation')
			->where('id', '=', $id)
			->lists('reservationNum');

		$tripNums = array();

		// getting all of our trip numbers
		foreach ($reservations as $reservation) {
			$tripNum = DB::table('payment')
				->where('reservationNum', '=', $reservation)
				->pluck('tripNum');

			array_push($tripNums, $tripNum);
		}

		$trips = array();

		// getting all of our associated trips
		foreach ($tripNums as $trip) {
			$oneTrip = DB::table('trip')
				->where('tripNum', '=', $trip)
				->get();

			array_push($trips, $oneTrip);
		}

		return View::make('users.client.flights', array(
			'trips' => $trips
			));
	}

}