<?php

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		$users = array(
			[
				'id'		=>	1,
				'firstname'	=> 'admin',
				'lastname'	=> 'admin',
				'username'	=> 'admin',
				'password'	=> Hash::make('password'),
				'role'		=> 'admin',
				'tripNum'	=> NULL
			],
			[
				'id'		=> 2,
				'firstname'	=> 'josh',
				'lastname'	=> 'black',
				'username'	=> 'joshblack',
				'password'	=> Hash::make('justinisdoge'),
				'role'		=> 'client',
				'tripNum'	=> 2
			],
			[
				'id'		=> 3,
				'firstname'	=> 'justin',
				'lastname'	=> 'rafanan',
				'username'	=> 'jrafanan',
				'password'	=> Hash::make('iamdoge'),
				'role'		=> 'agent',
				'tripNum'   => NULL
			]


			);

		DB::table('users')->insert($users);
	}
}