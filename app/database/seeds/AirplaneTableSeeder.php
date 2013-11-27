<?php

class AirplaneTableSeeder extends Seeder {

	public function run() {
		DB::table('airplane')->delete();

		$airplanes = array(
			[
				'airplane_id' 	=> '111',
				'plane_type'	=> '747',
				'numOfSeats'	=> 30
			],
			[
				'airplane_id' 	=> '222',
				'plane_type'	=> '747',
				'numOfSeats'	=> 30
			],
			[
				'airplane_id' 	=> '333',
				'plane_type'	=> '747',
				'numOfSeats'	=> 30
			],
			[
				'airplane_id' 	=> '444',
				'plane_type'	=> '747',
				'numOfSeats'	=> 30
			]
			);

		DB::table('airplane')->insert($airplanes);
	}
}