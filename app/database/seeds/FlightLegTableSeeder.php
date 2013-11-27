<?php 

class FlightLegTableSeeder extends Seeder {
	public function run() {
		DB::table('flightleg')->delete();

		$flightLegs = array();

		DB::table('flightleg')->insert($flightLegs);
	}
}