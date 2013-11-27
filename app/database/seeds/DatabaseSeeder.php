<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('AirlineTableSeeder');
		$this->call('AirplaneTableSeeder');
		// $this->call('FlightLegTableSeeder');
		// $this->call('PaymentTableSeeder');
		$this->call('ReservationTableSeeder');
		// $this->call('TripTableSeeder');
	}

}