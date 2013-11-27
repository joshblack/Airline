<?php

class AirlineTableSeeder extends Seeder {

	public function run() {
		DB::table('airline')->delete();

		$airlines = array(
			[
				'airline_code' 	=> 'CCC',
				'city' 			=> 'gainesville',
				'state' 		=> 'florida',
				'name' 			=> 'GNV Regional Airport'
			],
			[
				'airline_code'	=> 'EEE',
				'city'			=> 'atlanta',
				'state'			=> 'georgia',
				'name'			=> 'atl regional airport'
			],
			[
				'airline_code'	=> 'AAA',
				'city'			=> 'denver',
				'state'			=> 'colorado',
				'name'			=> 'dnv regional airport'
			],
			[
				'airline_code'	=> 'DDD',
				'city'			=> 'san francisco',
				'state'			=> 'california',
				'name'			=> 'SF airport'
			],
			[
				'airline_code'	=> 'BBB',
				'city' 			=> 'new york city',
				'state'			=> 'new york',
				'name'			=> 'ny airport'
			]
		);

		DB::table('airline')->insert($airlines);
	}
}