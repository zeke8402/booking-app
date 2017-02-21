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
        $table->integer('appointment_type');
        $table->datetime('appointment_datetime');
        $table->string('service_type');
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
