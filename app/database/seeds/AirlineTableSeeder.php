<?php

class AirlineTableSeeder extends Seeder {

	public function run() {
		DB::table('airline')->delete();

		$airlines = array(
			[
				'airline_code' 	=> '111',
				'city' 			=> 'gainesville',
				'state' 		=> 'florida',
				'name' 			=> 'GNV Regional Airport'
			],
			[
				'airline_code'	=> '222',
				'city'			=> 'atlanta',
				'state'			=> 'georgia',
				'name'			=> 'atl regional airport'
			],
			[
				'airline_code'	=> '333',
				'city'			=> 'denver',
				'state'			=> 'colorado',
				'name'			=> 'dnv regional airport'
			],
			[
				'airline_code'	=> '444',
				'city'			=> 'san francisco',
				'state'			=> 'california',
				'name'			=> 'SF airport'
			],
			[
				'airline_code'	=> '555',
				'city' 			=> 'new york city',
				'state'			=> 'new york',
				'name'			=> 'ny airport'
			]
		);

		DB::table('airline')->insert($airlines);
	}
}