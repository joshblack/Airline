<?php

class ReservationTableSeeder extends Seeder {
	public function run() {
		DB::table('reservation')->delete();

		$reservations = array(
			[
				'reservationNum'	=> 123,
				'email'				=> 'test1@dummy.com',
				'name'				=> 'john paul',
				'address'			=> 'your mom\'s house',
				'phone'				=> '911',
				'reservationDate'	=>	new DateTime('2013-01-01 12:30:00P'),
				'id'				=> 1
			],
			[
				'reservationNum'	=> 124,
				'email'				=> 'test2@dummy.com',
				'name'				=> 'john paul',
				'address'			=> 'your mom\'s house',
				'phone'				=> '811',
				'reservationDate'	=>	new DateTime('2013-01-01 1:30:00P'),
				'id'				=> 2
			],
			[
				'reservationNum'	=> 125,
				'email'				=> 'test3@dummy.com',
				'name'				=> 'john paul',
				'address'			=> 'your mom\'s house',
				'phone'				=> '711',
				'reservationDate'	=>	new DateTime('2013-01-01 2:30:00P'),
				'id'				=> 2
			],
			[
				'reservationNum'	=> 126,
				'email'				=> 'test4@dummy.com',
				'name'				=> 'john paul',
				'address'			=> 'your mom\'s house',
				'phone'				=> '611',
				'reservationDate'	=>	new DateTime('2013-01-01 3:30:00P'),
				'id'				=> 3
			]

			);

		DB::table('reservation')->insert($reservations);
	}
}