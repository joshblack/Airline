<?php

class AdminTableSeeder extends Seeder {

	public function run() {
		DB::table('airline')->delete();

		$airline = array(
			['airline_id'] => 'whatever'
			// more stuff
			);

		DB::table('airline')->insert($airline);
	}
}