<?php

class PaymentTableSeeder extends Seeder {
	public function run() {
		DB::table('payment')->delete();

		$payments = array(
			[
				'transactionNum' => 1,
				'paymentDate' => new DateTime('2013-01-01 12:30:00P'),
				'account' => 'account1',
				'nameOnAccount' => 'john paul',
				'reservationNum' => 123,
				'tripNum' => 1
			],
			[
				'transactionNum' => 2,
				'paymentDate' => new DateTime('2013-01-01 1:30:00P'),
				'account' => 'account2',
				'nameOnAccount' => 'john paw',
				'reservationNum' => 124,
				'tripNum' => 2
			],
			[
				'transactionNum' => 3,
				'paymentDate' => new DateTime('2013-01-01 2:30:00P'),
				'account' => 'account3',
				'nameOnAccount' => 'jon pah',
				'reservationNum' => 125,
				'tripNum' => 3
			],
			[
				'transactionNum' => 4,
				'paymentDate' => new DateTime('2013-01-01 3:30:00P'),
				'account' => 'account4',
				'nameOnAccount' => 'jun pool',
				'reservationNum' => 126,
				'tripNum' => 4
			]
			);

		DB::table('payment')->insert($payments);
	}
}