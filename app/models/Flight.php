<?php

class Flight extends Eloquent {


	public static getFlightTimes() {
		$varName = DB::table('airline')->where('time', '>', '2500');
		$queryLog
	}	
}