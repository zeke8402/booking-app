<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
     Schema::create('appointments', function($table) {
      	$table->increments('id');
        $table->integer('customer_id');
        $table->date('appointment_date');
        $table->time('appointment_time');
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
		//
    Schema::drop('appointments');
	}

}
