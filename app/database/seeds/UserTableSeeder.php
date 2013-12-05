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
				'role'		=> 'admin'
			],
			[
				'id'		=> 2,
				'firstname'	=> 'josh',
				'lastname'	=> 'black',
				'username'	=> 'joshblack',
				'password'	=> Hash::make('justinisdoge'),
				'role'		=> 'client'
			],
			[
				'id'		=> 3,
				'firstname'	=> 'justin',
				'lastname'	=> 'rafanan',
				'username'	=> 'jrafanan',
				'password'	=> Hash::make('iamdoge'),
				'role'		=> 'agent'
			]


			);

		DB::table('users')->insert($users);
	}
}