<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservation', function(Blueprint  $table) {
			$table->integer('reservationNum');
			$table->string('email');
			$table->string('name');
			$table->string('address');
			$table->string('phone');
			$table->datetime('reservationDate');

			$table->primary('reservationNum');
			// etc...
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reservation');
	}

}