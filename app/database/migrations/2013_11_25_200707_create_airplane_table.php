<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAirplaneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airplane', function(Blueprint  $table) {
			$table->string('airplane_id');
			$table->string('plane_type');
			$table->integer('numOfSeats');

			$table->primary('airplane_id');
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
		Schema::drop('airplane');
	}

}