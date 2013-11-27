<?php

class TripTableSeeder extends Seeder {
	public function run() {
		DB::table('trip')->delete();

		$trips = array(
			[
				'tripNum' => 1,
				'airline' => 'SouthWest',
				'price' => 645.00,
				'departure' => 'Gainesville',
				'destination' => 'San Francisco',
				'numOfLegs' => 2
			],
			[
				'tripNum' => 2,
				'airline' => 'United',
				'price' => 888.00,
				'departure' => 'New York',
				'destination' => 'Denver',
				'numOfLegs' => 1
			],
			[
				'tripNum' => 3,
				'airline' => 'Delta',
				'price' => 312.50,
				'departure' => 'Atlanta',
				'destination' => 'San Francisco',
				'numOfLegs' => 1
			],
			[
				'tripNum' => 4,
				'airline' => 'Swiss',
				'price' => 1121.89,
				'departure' => 'Gainesville',
				'destination' => 'New York',
				'numOfLegs' => 2
			],
			[
				'tripNum' => 5,
				'airline' => 'JetBlue',
				'price' => 500.23,
				'departure' => 'Denver',
				'destination' => 'Atlanta',
				'numOfLegs' => 2
			]
			);

		DB::table('trip')->insert($trips);
	}
}