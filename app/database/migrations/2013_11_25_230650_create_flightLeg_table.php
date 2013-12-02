<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlightLegTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flightLeg', function(Blueprint  $table) {
			$table->integer('legNum');
			$table->integer('numSeatsAvail');
			$table->datetime('flightLegDate');
			$table->datetime('arrivalTime');
			$table->datetime('departureTime');
			$table->string('airplaneID');
			$table->string('arrivalCode',3);
			$table->string('departureCode',3);
			$table->integer('tripNum');

			$table->primary(array('legNum','tripNum'));
			$table->foreign('airplaneID')->references('airplane_id')->on('airplane');
			$table->foreign('arrivalCode')->references('airline_code')->on('airline');
			$table->foreign('departureCode')->references('airline_code')->on('airline');
			$table->foreign('tripNum')->references('tripNum')->on('trip')->onDelete('cascade');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flightLeg');
	}
}