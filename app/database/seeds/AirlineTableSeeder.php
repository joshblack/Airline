<?php

class AdminTableSeeder extends Seeder {

	public function run() {
		DB::table('airline')->delete();

		$airline = array(
			['airline_id' => 'whatever',
			'attribute_name' => 'tuple value at attribute',

			]
			// more stuff
			);

		DB::table('airline')->insert($airline);
	}
}