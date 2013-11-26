<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trip', function(Blueprint  $table) {
			$table->integer('tripNum');
			$table->string('airline');
			$table->float('price');
			$table->string('departure');
			$table->string('destination');
			$table->integer('numOfLegs');

			$table->primary('tripNum');
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
		Schema::drop('trip');
	}

}