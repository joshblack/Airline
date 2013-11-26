<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment', function(Blueprint  $table) {
			$table->integer('transactionNum');
			$table->datetime('paymentDate');
			$table->string('account');
			$table->string('nameOnAccount');
			$table->integer('reservationNum');
			$table->integer('tripNum');

			$table->foreign('reservationNum')->references('reservationNum')->on('reservation')->onDelete('cascade');
			$table->foreign('tripNum')->references('tripNum')->on('trip')->onDelete('cascade');	
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
		Schema::drop('payment');
	}

}