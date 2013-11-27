<?php

class TripTableSeeder extends Seeder {
	public function run() {
		DB::table('trip')->delete();

		$trips = array();

		DB::table('trip')->insert($trips);
	}
}