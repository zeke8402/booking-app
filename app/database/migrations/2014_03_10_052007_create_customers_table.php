<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('customers', function($table) {
      	$table->increments('id');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('contact_number');
        $table->string('email');
        $table->boolean('wants_updates');
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
    Schema::drop('customers');
	}

}
