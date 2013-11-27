<?php

class PaymentTableSeeder extends Seeder {
	public function run() {
		DB::table('payment')->delete();

		$payments = array();

		DB::table('payment')->insert($payments);
	}
}