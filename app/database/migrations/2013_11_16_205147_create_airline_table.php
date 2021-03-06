<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAirlineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airline', function(Blueprint  $table) {
			$table->string('airline_code', 3);
			$table->string('city');
			$table->string('state');
			$table->string('name');

			$table->primary('airline_code');
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
		Schema::drop('airline');
	}

}