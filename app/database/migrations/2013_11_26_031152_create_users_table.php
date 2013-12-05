<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint  $table) {
			$table->increments('id');
			$table->string('firstname', 20);
			$table->string('lastname', 20);
			$table->string('username', 100)->unique();
			$table->string('password', 64);
			$table->string('role', 20);
			$table->integer('tripNum')->nullable()->default(NULL);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}