<?php 

class FlightLegTableSeeder extends Seeder {
	public function run() {
		DB::table('flightleg')->delete();

		$flightLegs = array(
			[
				'legNum' 	=> 1,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-02 12:30:00P'),
				'arrivalTime' => new DateTime('2013-02-02 1:30:00P'),
				'departureTime' => new DateTime('2013-02-02 12:30:00P') ,
				'airplaneID' => '111',
				'arrivalCode' => 'AAA',
				'departureCode' => 'BBB',
				'tripNum' => 2
			],
			[
				'legNum' 	=> 2,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-01 12:30:00P'),
				'arrivalTime' => new DateTime('2013-02-01 1:30:00P'),
				'departureTime' => new DateTime('2013-02-01 12:30:00P') ,
				'airplaneID' => '111',
				'arrivalCode' => 'AAA',
				'departureCode' => 'CCC',
				'tripNum' => 4
			],
			[
				'legNum' 	=> 3,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-01 12:30:00P'),
				'arrivalTime' => new DateTime('2013-02-01 1:30:00P'),
				'departureTime' => new DateTime('2013-02-01 12:30:00P') ,
				'airplaneID' => '222',
				'arrivalCode' => 'AAA',
				'departureCode' => 'CCC',
				'tripNum' => 1
			],
			[
				'legNum' 	=> 4,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-01 2:30:00P'),
				'arrivalTime' => new DateTime('2013-02-01 3:30:00P'),
				'departureTime' => new DateTime('2013-02-01 2:30:00P') ,
				'airplaneID' => '222',
				'arrivalCode' => 'DDD',
				'departureCode' => 'AAA',
				'tripNum' => 1
			],
			[
				'legNum' 	=> 5,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-01 12:30:00P'),
				'arrivalTime' => new DateTime('2013-02-01 1:30:00P'),
				'departureTime' => new DateTime('2013-02-01 12:30:00P') ,
				'airplaneID' => '333',
				'arrivalCode' => 'DDD',
				'departureCode' => 'EEE',
				'tripNum' => 3
			],
			[
				'legNum' 	=> 6,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-01 2:00:00P'),
				'arrivalTime' => new DateTime('2013-02-01 3:30:00P'),
				'departureTime' => new DateTime('2013-02-01 2:00:00P') ,
				'airplaneID' => '111',
				'arrivalCode' => 'BBB',
				'departureCode' => 'AAA',
				'tripNum' => 4
			],
			[
				'legNum' 	=> 7,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-03 12:30:00P'),
				'arrivalTime' => new DateTime('2013-02-03 4:30:00P'),
				'departureTime' => new DateTime('2013-02-03 12:30:00P') ,
				'airplaneID' => '444',
				'arrivalCode' => 'CCC',
				'departureCode' => 'AAA',
				'tripNum' => 5
			],
			[
				'legNum' 	=> 8,
				'numSeatsAvail'	=> 30,
				'flightLegDate'	=> new DateTime('2013-02-03 6:30:00P'),
				'arrivalTime' => new DateTime('2013-02-03 8:30:00P'),
				'departureTime' => new DateTime('2013-02-03 6:30:00P') ,
				'airplaneID' => '444',
				'arrivalCode' => 'EEE',
				'departureCode' => 'CCC',
				'tripNum' => 5
			]
			);

		DB::table('flightleg')->insert($flightLegs);
	}
}