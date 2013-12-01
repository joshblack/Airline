<?php

class AgentController extends BaseController {

	public function showIndex() {

		$trips = DB::table('trip')->get();

		return View::make('users.agents.index', array(
			'trips' => $trips
			));
	}

	public function showReservations() {
		$reservations = DB::table('reservation')->get();

		return View::make('reservations.index', array(
			'reservations' => $reservations
			));
	}

	public function edit($reservationId) {
		$reservation = DB::table('reservation')
			->where('reservationNum', '=', $reservationId)
			->get();

		return View::make('reservations.edit', array(
			'reservation' => $reservation
			));
	}

	public function update($reservationId) {
		$input = Input::get();

		$newReservation = array(
			'reservationNum' => $input['reservationNum'],
			'email'	=>	$input['email'],
			'name' => $input['name'],
			'address' => $input['address'],
			'phone'	=> $input['phone']
			);

		DB::table('reservation')
            ->where('reservationNum', $input['reservationNum'])
            ->update($newReservation);

		return Redirect::to('/agents/reservations')->with('success', 'Your reservation information has been saved');
	}

	public function destroy($reservationId) {
		$reservation = DB::table('reservation')
			->where('reservationNum', '=', $reservationId)
			->delete();

		return Redirect::to('/agents/reservations')->with('success', 'Your reservation information has been deleted');
	}
}